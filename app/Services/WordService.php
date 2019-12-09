<?php

namespace App\Services;

use App\Http\Requests\{SearchRequest, CreateWordRequest};
use App\Models\Translate;
use App\Models\Word;
use App\Repositories\Translate\TranslateRepositoryInterface;
use Auth;
use Doctrine\DBAL\DBALException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use PDO;

/**
 * Class WordService
 * @package App\Services
 */
class WordService
{
    /**
     * @var TranslateRepositoryInterface
     */
    private $translateRepository;

    /**
     * WordService constructor.
     * @param TranslateRepositoryInterface $translateRepository
     */
    public function __construct(TranslateRepositoryInterface $translateRepository)
    {
        $this->translateRepository = $translateRepository;
    }

    public function create(CreateWordRequest $request)
    {
        $word = new Word([
            'word' => $request->get('orig'),
            'sentence' => 0,
            'is_public' => $request->get('is_public'),
            'creator' => Auth::user()->id,
            'lang' => config('app.lang')
        ]);

        $word->translates()->create([
            'value' => $request->get('translate'),
            'sentence' => 0,
            'is_public' => $request->get('is_public')
        ]);

        $word->load('translates');

        return $word;
    }

    /**
     * @param SearchRequest $request
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

        $params = [$word, $word, $word."%", $word, $sentence, Auth::user()->getKey(), config('app.lang')];

        $stmt = app('em')->getConnection()->prepare($sql);
        $stmt->execute($params);
        $ids = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        return $this->translateRepository->searchByIds($ids);
    }
}