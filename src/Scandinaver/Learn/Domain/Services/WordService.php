<?php


namespace Scandinaver\Learn\Domain\Services;

use App\Http\Requests\{SearchRequest};
use Auth;
use Doctrine\DBAL\DBALException;
use Illuminate\Database\Eloquent\{Builder, Collection};
use PDO;
use Scandinaver\Common\Domain\Contracts\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Contracts\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contracts\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Translate;
use Scandinaver\Learn\Domain\Word;

/**
 * Class WordService
 *
 * @package App\Services
 */
class WordService
{
    /**
     * @var LanguageRepositoryInterface
     */
    protected $languageRepository;

    /**
     * @var TranslateRepositoryInterface
     */
    private $translateRepository;

    /**
     * @var WordRepositoryInterface
     */
    private $wordsRepository;

    /**
     * WordService constructor.
     *
     * @param TranslateRepositoryInterface $translateRepository
     * @param WordRepositoryInterface      $wordsRepository
     * @param LanguageRepositoryInterface  $languageRepository
     */
    public function __construct(TranslateRepositoryInterface $translateRepository, WordRepositoryInterface $wordsRepository, LanguageRepositoryInterface $languageRepository)
    {
        $this->translateRepository = $translateRepository;
        $this->wordsRepository     = $wordsRepository;
        $this->languageRepository  = $languageRepository;
    }

    /**
     * @param Language $language
     *
     * @return int
     */
    public function count(Language $language): int
    {
        return $this->wordsRepository->getCountByLanguage($language);
    }

    /**TODO: проверить
     *
     * @param        $lang
     * @param string $word
     * @param int    $isSentence
     * @param string $translate
     *
     * @return Word
     */
    public function create($lang, string $word, int $isSentence, string $translate): Word
    {
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
     * @param SearchRequest $request
     *
     * @return Translate[]|Builder[]|Collection|\Illuminate\Support\Collection
     * @throws DBALException
     */
    public function translate(SearchRequest $request)
    {
        $word = $request->get('word');

        $sentence = intval($request->get('sentence'));

        $sql = 'select t.id,
                            MATCH (t.value) AGAINST (? IN NATURAL LANGUAGE MODE) as score
                              from translate as t
                                left join words as w
                                  on t.word_id = w.id
                                left join users as u 
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

        $params = [$word, $word, $word . "%", $word, $sentence, Auth::user()->getKey(), config('app.lang')];

        $stmt = app('em')->getConnection()->prepare($sql);
        $stmt->execute($params);
        $ids = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        return $ids ? $this->translateRepository->searchByIds($ids) : [];
    }

    /**
     * @param Word $word
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