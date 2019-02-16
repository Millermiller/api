<?php

namespace App\Http\Controllers\Main\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Example;
use App\Models\Language;
use App\Models\Result;
use App\User;

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
        $languages = Language::all();

        $response = [];

        foreach($languages as $language){
            $response[] = [
                'name' => $language->label,
                'flag' => $language->image,
                'letter' => $language->name,
                'cards' => Card::whereHas('asset', function($q) use ($language) {
                    /** @var \Illuminate\Database\Eloquent\Builder $q*/
                    $q->where('lang', $language->name);
                })->count()
            ];
        }

        return response()->json($response);
    }

    public function assets($language)
    {
        config(['app.lang' => $language]);

        /** @var User $user */
        $user = auth('api')->user();

        $assets = [];

        $activeArray = Result::domain()->where('user_id', $user->id)->pluck('result', 'asset_id')->toArray();

        $personaldata = Asset::domain()->whereHas('result', function ($q) use ($user) {
            /** @var \Illuminate\Database\Eloquent\Builder $q*/
            $q->where('user_id', $user->id);
        })->with('cards', 'cards.word', 'cards.translate', 'result')->get();

        $publicdata = Asset::domain()->with('cards', 'cards.word', 'cards.translate', 'result')->where('basic', 1)->get();

        $data = $personaldata->merge($publicdata);

        $counter = [
            Asset::TYPE_WORDS => 0,
            Asset::TYPE_SENTENCES => 0,
            Asset::TYPE_PERSONAL => 0,
            Asset::TYPE_FAVORITES => 0,
        ];

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
                'active' => in_array($item->id, array_keys($activeArray)),
                'count' => $item->cards->count(),
                'result' => 0,
                'level' => $item->level,
                'title' => $item->title,
                'type' => $item->type,
                'basic' => $item->basic,
                'cards' => $cards
            ];

            $counter[$item->type] = $counter[$item->type] + 1;

            if((in_array($item->type, [Asset::TYPE_WORDS, Asset::TYPE_SENTENCES]) && $counter[$item->type] < 10) || $user->premium || in_array($item->type, [Asset::TYPE_FAVORITES, Asset::TYPE_PERSONAL]))
                $asset['available'] = true;
            else
                $asset['available'] = false;

            $assets[] = $asset;
        }

        return response()->json($assets);
    }
} 