<?php


namespace Scandinaver\Translate\Domain\Service;

use Exception;
use PDO;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Service\LanguageTrait;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Translate\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\DTO\TextDTO;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Model\Result;
use Scandinaver\Translate\Domain\Model\Text;

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
        $this->textRepository   = $textRepository;
        $this->resultRepository = $resultRepository;
    }

    public function count(): int
    {
        return $this->textRepository->count([]);
    }

    /**
     * @param  string  $language
     *
     * @return int
     * @throws LanguageNotFoundException
     */
    public function countByLanguage(string $language): int
    {
        $language = $this->getLanguage($language);

        return $this->textRepository->getCountByLanguage($language);
    }

    /**
     * @param  string  $language
     *
     * @return array|Text[]
     * @throws LanguageNotFoundException
     */
    public function getAllByLanguage(string $language): array
    {
        $language = $this->getLanguage($language);

        /** @var Text $texts */
        return $this->textRepository->findBy(['language' => $language]);
    }

    /**
     * @param  string         $language
     * @param  UserInterface  $user
     *
     * @return array|TextDTO[]
     * @throws LanguageNotFoundException
     */
    public function getTextsForUser(string $language, UserInterface $user): array
    {
        $language = $this->getLanguage($language);

        $activeArray = $this->textRepository->getActiveIds($user, $language);

        $texts = $this->textRepository->getByLanguage($language);

        $counter = 0;

        $textsDTO = [];

        foreach ($texts as &$text) {

            $textDTO = TextFactory::toDTO($text);

            $counter++;

            $textDTO->setActive(in_array($text->getId(), $activeArray));

            $textDTO->setAvailable($counter < 3 || $user->isActive());

            $textsDTO[] = $textDTO;
        }

        return $textsDTO;
    }

    /**
     * @param  int  $textId
     *
     * @return Text
     * @throws Exception
     * @throws TextNotFoundException|\Doctrine\DBAL\Driver\Exception
     */
    public function prepareText(int $textId): Text
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

    /**
     * @param  UserInterface  $user
     * @param  int            $textId
     *
     * @return Text
     * @throws TextNotFoundException
     */
    public function giveNextLevel(UserInterface $user, int $textId): Text
    {
        $text = $this->getText($textId);

        $nextText = $this->textRepository->getNextText($text);

        $result = $this->resultRepository->findOneBy(
            ['user' => $user, 'text' => $text]
        );

        if ($result === NULL) {
            $result = new Result($nextText, $user, $text->getLanguage());
        }

        $result = $this->resultRepository->save($result);

        return $nextText;
    }

    public function removePassingsByUser(UserInterface $user): void
    {
        /** @var Result[] $passings */
        $passings = $this->resultRepository->findBy([
            'user' => $user
        ]);

        foreach ($passings as $passing) {
            $this->resultRepository->delete($passing);
        }
    }
}