<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Card;
use App\Http\Requests\{SearchRequest};
use Auth;
use Doctrine\DBAL\DBALException;
use Illuminate\Database\Eloquent\{Builder, Collection};
use PDO;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Model\Word;

/**
 * Class WordService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class WordService
{
    protected LanguageRepositoryInterface $languageRepository;

    private TranslateRepositoryInterface $translateRepository;

    private WordRepositoryInterface $wordsRepository;

    /**
     * WordService constructor.
     *
     * @param  TranslateRepositoryInterface  $translateRepository
     * @param  WordRepositoryInterface       $wordsRepository
     * @param  LanguageRepositoryInterface   $languageRepository
     */
    public function __construct(
        TranslateRepositoryInterface $translateRepository,
        WordRepositoryInterface $wordsRepository,
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->translateRepository = $translateRepository;
        $this->wordsRepository = $wordsRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->wordsRepository->count([]);
    }

    /**
     * @param  Language  $language
     *
     * @return int
     */
    public function countByLanguage(Language $language): int
    {
        return $this->wordsRepository->getCountByLanguage($language);
    }

    /**TODO: проверить
     *
     * @param          $lang
     * @param  string  $word
     * @param  int     $isSentence
     * @param  string  $translate
     *
     * @return Word
     */
    public function create(
        $lang,
        string $word,
        int $isSentence,
        string $translate
    ): Word {
        $language = $this->languageRepository->get($lang);

        $word = new Word();
        $word->setLanguage($language);
        $word->setWord($word);
        $word->setSentence($isSentence);

        $translate = new Translate();
        $translate->setValue($translate);
        $translate->setWord($word);

        $this->wordsRepository->save($word);
        $this->translateRepository->save($translate);
    }

    /**
     * @param  Language       $language
     * @param  SearchRequest  $request
     *
     * @return Translate[]|Builder[]|Collection|\Illuminate\Support\Collection
     * @throws DBALException
     */
    public function translate(Language $language, SearchRequest $request)
    {
        $word = $request->get('word');

        $sentence = intval($request->get('sentence'));

        $sql = 'select t.id,
                            MATCH (t.value) AGAINST (? IN NATURAL LANGUAGE MODE) as score
                              from translate as t
                                left join word as w
                                  on t.word_id = w.id
                                left join user as u 
                                  on u.id = w.creator_id
                            where (MATCH(t.value) AGAINST(? IN BOOLEAN MODE)
                                or t.value like ?
                                or t.value = ?
                                )
                            and t.sentence = ?
                            and w.deleted_at is null 
                            and (w.is_public = 1 or (w.is_public = 0 and w.creator_id = ?))
                            and w.language_id = ?
                            order by score desc';

        $params = [
            $word,
            $word,
            $word."%",
            $word,
            $sentence,
            Auth::user()->getKey(),
            $language->getId(),
        ];

        $stmt = app('em')->getConnection()->prepare($sql);
        $stmt->execute($params);
        $ids = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        $result = [];

        if ($ids) {
            $translates = $ids ? $this->translateRepository->searchByIds($ids) : [];
            /** @var Translate $translate */
            foreach ($translates as $translate) {
                $card = new Card($translate->getWord(), null, $translate);
                $result[] = $card;
            }
        }
        return $result;
    }

    /**
     * @param  Word  $word
     *
     * @return Translate[]
     */
    public function getTranslates(Word $word): array
    {
        return $this->translateRepository->searchByIds([$word->getId()]);
    }

    /**
     * @return array
     * @throws DBALException
     */
    public function getSentences(): array
    {
        $sql = 'SELECT w.id, w.word, t.value, t.id as translate_id
                         FROM words as w
                         JOIN translate as t
                            ON w.id = t.word_id
                         WHERE w.sentence = 1
                         AND w.id NOT IN(SELECT word_id FROM cards)
                         AND w.deleted_at is NULL ';

        $stmt = app('em')->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}