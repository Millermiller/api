<?php


namespace Scandinaver\Learn\Domain\Services;

use App\Http\Requests\{SearchRequest};
use Auth;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Domain\Services\LanguageTrait;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Shared\Contract\BaseServiceInterface;
use Scandinaver\Shared\DTO;

/**
 * Class WordService
 *
 * @package Scandinaver\Learn\Domain\Services
 */
class WordService implements BaseServiceInterface
{
    use LanguageTrait;

    protected LanguageRepositoryInterface $languageRepository;

    private TranslateRepositoryInterface $translateRepository;

    private WordRepositoryInterface $wordsRepository;

    private CardRepositoryInterface $cardRepository;

    public function __construct(
        TranslateRepositoryInterface $translateRepository,
        WordRepositoryInterface $wordsRepository,
        CardRepositoryInterface $cardRepository,
        LanguageRepositoryInterface $languageRepository
    ) {
        $this->translateRepository = $translateRepository;
        $this->wordsRepository     = $wordsRepository;
        $this->languageRepository  = $languageRepository;
        $this->cardRepository      = $cardRepository;
    }

    public function count(): int
    {
        return $this->wordsRepository->count([]);
    }

    public function countByLanguage(string $language): int
    {
        /** @var Language $language */
        $language = $this->languageRepository->find($language);

        return $this->wordsRepository->getCountByLanguage($language);
    }

    /**TODO: проверить
     *
     * @param  string  $language
     * @param  string  $word
     * @param  int     $isSentence
     * @param  string  $translate
     *
     * @return Word
     */
    public function create(
        string $language,
        string $word,
        int $isSentence,
        string $translate
    ): Word {
        $language = $this->languageRepository->find($language);

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
     * @param  string         $language
     * @param  SearchRequest  $request
     *
     * @return Translate[]|Builder[]|Collection|\Illuminate\Support\Collection
     * @throws LanguageNotFoundException
     */
    public function translate(string $language, SearchRequest $request)
    {
        $language = $this->getLanguage($language);

        $word = $request->get('query');

        $sentence = intval($request->get('sentence'));

        $cards = $this->cardRepository->search($language, $word, (bool)$sentence);

        $sql = 'select t.id,
                            MATCH (t.value) AGAINST (? IN NATURAL LANGUAGE MODE) as score
                              from translate as t
                                left join word as w
                                  on t.word_id = w.id
                            where (MATCH(t.value) AGAINST(? IN BOOLEAN MODE)
                                or t.value like ?
                                or t.value = ?
                                )
                            and t.sentence = ?
                           -- and w.deleted_at is null 
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

        // $stmt = app('em')->getConnection()->prepare($sql);
        // $stmt->execute($params);
        // $ids = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        $result = [];

        //if ($ids) {
        //    $translates = $ids ? $this->translateRepository->searchByIds($ids) : [];
        //    /** @var Translate $translate */
        //    foreach ($translates as $translate) {
        //        /** @var Card $card */
        //        $card = $this->cardRepository->findOneBy(
        //            [
        //                'translate' => $translate,
        //            ]
        //        );
        //        if ($card !== null) {
        //            $result[] = $card->toDTO();
        //        }
        //    }
        //}

        foreach ($cards as $card) {
            $result[] = $card->toDTO();
        }

        return $result;
    }

    public function getTranslates(int $word): array
    {
        return $this->translateRepository->searchByIds([$word]);
    }

    /**
     * @param  string  $language
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function getSentences(string $language): array
    {
        $language = $this->getLanguage($language);

        $result = [];

        /** @var Card[] $cards */
        $cards = $this->cardRepository->findBy(
            [
                'language' => $language,
                'type'     => 1,
            ]
        );

        foreach ($cards as $card) {
            $result[] = $card->toDTO();
        }

        return $result;
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }

    public function one(int $id): DTO
    {
        // TODO: Implement one() method.
    }

}