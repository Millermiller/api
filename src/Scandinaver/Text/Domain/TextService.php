<?php

namespace Scandinaver\Text\Domain;

use PDO;
use Auth;
use App\Entities\{Language, User};
use App\Events\NextTextLevel;
use App\Repositories\Language\LanguageRepositoryInterface;
use Doctrine\DBAL\DBALException;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class TextService
 * @package Scandinaver\Text\Domain;
 */
class TextService
{
    /**
     * @var TextRepositoryInterface
     */
    private $textRepository;

    /**
     * @var LanguageRepositoryInterface
     */
    private $languageRepository;

    /**
     * @var ResultRepositoryInterface
     */
    protected $resultRepository;

    /**
     * TextService constructor.
     * @param TextRepositoryInterface $textRepository
     * @param LanguageRepositoryInterface $languageRepository
     * @param ResultRepositoryInterface $resultRepository
     */
    public function __construct(TextRepositoryInterface $textRepository, LanguageRepositoryInterface $languageRepository, ResultRepositoryInterface $resultRepository)
    {
        $this->textRepository = $textRepository;
        $this->languageRepository = $languageRepository;
        $this->resultRepository   = $resultRepository;
    }

    /**
     * @param User $user
     * @return array
     */
    public function getTextsForUser(User $user)
    {
        /** @var Language $language */
        $language = $this->languageRepository->get(config('app.lang'));

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
                    'description' => $text->getDescription()
                ];
            } else {
                $text = [
                    'id' => $text->getId(),
                    'title' => $text->getTitle(),
                    'active' => false,
                    'image' => $text->getImage(),
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
     * @param  Text $text
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
     * @param  Authenticatable|User $user
     * @param  Text $text
     * @return Text
     */
    public function giveNextLevel(Authenticatable $user, Text $text): Text
    {
        $language  = $this->languageRepository->get(config('app.lang'));

        $nextText = $this->textRepository->getNextText($text, $language);

        $result = $this->resultRepository->findOneBy(['user' => $user, 'text' => $text]);

        if($result === null) $result = new Result($nextText, $user, $language);

        $result = $this->resultRepository->save($result);

        event(new NextTextLevel(Auth::user(), $result));

        return $nextText;
    }
}