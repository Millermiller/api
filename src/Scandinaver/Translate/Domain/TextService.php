<?php


namespace Scandinaver\Translate\Domain;

use App\Events\NextTextLevel;
use Doctrine\DBAL\DBALException;
use PDO;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Translate\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Model\Result;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\User\Domain\Model\User;

/**
 * Class TextService
 *
 * @package Scandinaver\Translate\Domain;
 */
class TextService
{
    use LanguageTrait;
    use TextTrait;

    protected ResultRepositoryInterface $resultRepository;

    private TextRepositoryInterface $textRepository;

    public function __construct(
        TextRepositoryInterface $textRepository,
        ResultRepositoryInterface $resultRepository
    ) {
        $this->textRepository = $textRepository;
        $this->resultRepository = $resultRepository;
    }

    public function count(): int
    {
        return $this->textRepository->count([]);
    }

    public function countByLanguage(string $language): int
    {
        $language = $this->getLanguage($language);

        return $this->textRepository->getCountByLanguage($language);
    }

    public function getAllByLanguage(string $language): array
    {
        $language = $this->getLanguage($language);

        $result = [];

        /** @var Text $texts */
        $texts = $this->textRepository->findBy(['language' => $language]);

        foreach ($texts as $text) {
            $result[] = $text->toDTO();
        }

        return $result;
    }

    public function getTextsForUser(string $language, User $user): array
    {
        $language = $this->getLanguage($language);

        $activeArray = $this->textRepository->getActiveIds($user, $language);

        $texts = $this->textRepository->getByLanguage($language);

        $counter = 0;

        foreach ($texts as &$text) {
            $counter++;

            if (in_array($text->getId(), $activeArray)) {
                $text = [
                    'id' => $text->getId(),
                    'title' => $text->getTitle(),
                    'active' => true,
                    'image' => $text->getImage(),
                    'description' => $text->getDescription(),
                ];
            } else {
                $text = [
                    'id' => $text->getId(),
                    'title' => $text->getTitle(),
                    'active' => false,
                    'image' => $text->getImage(),
                    'description' => $text->getDescription(),
                ];
            }


            if ($counter < 3 || $user->getActive()) {
                $text['available'] = true;
            } else {
                $text['available'] = false;
            }
        }

        return $texts;
    }

    /**
     * @param  int  $textId
     *
     * @return Text
     * @throws DBALException
     * @throws Exception\TextNotFoundException
     */
    public function prepareText(int $textId)
    {
        $text = $this->getText($textId);

        $sql = 'select 
                              w.word as word,  w.orig
                                  from word_in_text as w
                                    where text_id = ? and w.orig != ""
                              union 
                                  select s.synonym as word,  w.orig
                                    from word_in_text as w
                                      left join synonym as s
                                        on s.word_id = w.id
                                      where text_id = ?
                                    ';


        $params = [$text->getId(), $text->getId()];

        $stmt = app('em')->getConnection()->prepare($sql);
        $stmt->execute($params);
        $words = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = [];

        foreach ($words as $word) {
            $data[mb_strtolower($word['word'])][] = trim($word['orig']);
        }

        $text->setSynonims($data);

        return $text;
    }

    public function giveNextLevel(User $user, int $textId): Text
    {
        $text = $this->getText($textId);

        $nextText = $this->textRepository->getNextText($text);

        $result = $this->resultRepository->findOneBy(
            ['user' => $user, 'text' => $text]
        );

        if ($result === null) {
            $result = new Result($nextText, $user, $text->getLanguage());
        }

        $result = $this->resultRepository->save($result);

        event(new NextTextLevel($user, $result));

        return $nextText;
    }
}