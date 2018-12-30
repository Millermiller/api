<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Example;
use App\Models\Result;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 19.02.15
 * Time: 23:08
 *
 * Class ApiController
 * @package App\Http\Controllers\Main\Frontend
 *
 */
class ApiController extends Controller
{
    public function languages()
    {
        return response()->json([
            [
                'name' => 'Исландский',
                'flag' => 'https://scandinaver.org/img/is_round.png',
                'letter' => 'is'
            ],
            [
                'name' => 'Шведский',
                'flag' => 'https://scandinaver.org/img/sw_round.png',
                'letter' => 'sw'
            ],
        ]);
    }

    public function assets($language)
    {
        config(['app.lang' => $language]);

        $user = auth('api')->user();

        $assets = [];

        $activeArray = Result::domain()->where('user_id', $user->id)->pluck('result', 'asset_id')->toArray();

        $personaldata = Asset::domain()->whereHas('result', function ($q) use ($user) {
            /** @var \Illuminate\Database\Eloquent\Builder $q*/
            $q->where('user_id', $user->id);
        })->with('cards', 'cards.word', 'cards.translate', 'result')->get();

        $publicdata = Asset::domain()->with('cards', 'cards.word', 'cards.translate', 'result')->where('basic', 1)->get();

        $data = $personaldata->merge($publicdata);


        foreach ($data as $item) {
            $cards = [];

            foreach ($item->cards as $card) {
                if(! $card->word) continue;

                $cards[] = [
                    'id' => $card->id,
                    'word' => $card->word->word,
                    'trans' => $card->translate->value,
                    'asset_id' => $card->asset_id,
                    'examples' => Example::where('card_id', '=', $card->id)->get()
                ];
            }

            $asset = [
                'id' => $item->id,
                'active' => (in_array($item->id, array_keys($activeArray))) ? 1 : 0,
                'count' => $item->cards->count(),
                'result' => 0,
                'level' => $item->level,
                'title' => $item->title,
                'type' => $item->type,
                'basic' => $item->basic,
                'cards' => $cards
            ];

            $assets[] = $asset;
        }

        return response()->json($assets);
    }
} 