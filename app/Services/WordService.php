<?php

namespace App\Services;

use App\Http\Requests\CreateWordRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Translate;
use App\Models\Word;
use Auth;
use DB;

/**
 * Class WordService
 * @package App\Services
 */
class WordService
{
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
     * @return Translate[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function translate(SearchRequest $request)
    {
        $word = $request->get('word');

        $sentence = intval($request->get('sentence'));

        $ids = Word::tr($word, $sentence);

        $ids = array_pluck($ids, 'id');

        $tempStr = implode(',', $ids);

        $words = Translate::with(['word'])->whereIn("translate.id", $ids)->orderByRaw(DB::raw("FIELD(id, $tempStr)"))->get();

        return $words;
    }
}