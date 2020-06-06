<?php


namespace Scandinaver\Translate\Domain;

use App\Events\NextTextLevel;
use Doctrine\DBAL\DBALException;
use Illuminate\Contracts\Auth\Authenticatable;
use PDO;
use Scandinaver\Common\Domain\Language;
use Scandinaver\Translate\Domain\Contracts\ResultRepositoryInterface;
use Scandinaver\Translate\Domain\Contracts\TextRepositoryInterface;
use Scandinaver\User\Domain\User;

/**
 * Class TextService
 *
 * @package Scandinaver\Translate\Domain;
 */
class TextService
{
    /**
     * @var ResultRepositoryInterface
     */
    protected $resultRepository;

    /**
     * @var TextRepositoryInterface
     */
    private $textRepository;

    /**
     * TextService constructor.
     *
     * @param TextRepositoryInterface   $textRepository
     * @param ResultRepositoryInterface $resultRepository
     */
    public function __construct(TextRepositoryInterface $textRepository, ResultRepositoryInterface $resultRepository)
    {
        $this->textRepository   = $textRepository;
        $this->resultRepository = $resultRepository;
    }

    /**
     *
     * @return int
     */
    public function count(): int
    {
        return $this->textRepository->count([]);
    }

    /**
     * @param Language $language
     *
     * @return int
     */
    public function countByLanguage(Language $language): int
    {
        return $this->textRepository->getCountByLanguage($language);
    }

    /**
     * @param Language $language
     * @param User     $user
     *
     * @return array
     */
    public function getTextsForUser(Language $language, User $user)
    {
        $activeArray = $this->textRepository->getActiveIds($user, $language);

        $texts = $this->textRepository->getByLanguage($language);

        $counter = 0;

        foreach ($texts as &$text) {
            $counter++;

            if (in_array($text->getId(), $activeArray)) {
                $text = [
                    'id'          => $text->getId(),
                    'title'       => $text->getTitle(),
                    'active'      => true,
                    'image'       => $text->getImage(),
                    'description' => $text->getDescription()
                ];
            } else {
                $text = [
                    'id'          => $text->getId(),
                    'title'       => $text->getTitle(),
                    'active'      => false,
                    'image'       => $text->getImage(),
                    'description' => $text->getDescription()
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
     * @param Text $text
     *
     * @return Text
     * @throws DBALException
     */
    public function prepareText(Text $text)
    {
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
     * @param Language             $language
     * @param Authenticatable|User $user
     * @param Text                 $text
     *
     * @return Text
     */
    public function giveNextLevel(Language $language, Authenticatable $user, Text $text): Text
    {
        $nextText = $this->textRepository->getNextText($text, $language);

        $result = $this->resultRepository->findOneBy(['user' => $user, 'text' => $text]);

        if ($result === null) $result = new Result($nextText, $user, $language);

        $result = $this->resultRepository->save($result);

        event(new NextTextLevel($user, $result));

        return $nextText;
    }
}