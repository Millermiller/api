<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Events\NextLevel;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Result;
use Auth;
use Illuminate\Support\Facades\Input;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.05.2015
 * Time: 3:10
 *
 * Class TestController
 * @package App\Http\Controllers\Sub\Frontend
 */
class TestController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAsset()
    {
        return response()->json(Card::getCards(Input::get('asset_id')));
    }

    /**
     * Даем юзеру следующий уровень данного набора (если есть)
     * todo: допилить!
     */
    public function nextLevel()
    {
        $asset_id = Input::get('asset_id');

        $next_asset_id = Asset::getNextLevel($asset_id)->id;// получаем id следующего набора

        if ($next_asset_id > 0 &&
            !Result::where('asset_id', $next_asset_id)
                ->where('user_id', Auth::user()->id)
                ->get()
                ->count()
        ) {

            /** @var Result $result */
            $result = new Result(['asset_id' => $next_asset_id, 'user_id' => Auth::user()->id,]);

            if ($result->save()) {

                event(new NextLevel(Auth::user(), $result));

                return response()->json([
                    'success' => true,
                    'new level' => $next_asset_id,
                    'msg' => $result->asset->title . $result->asset->level
                ]);
            }
        }
    }

    /**
     * Сохранить результат
     */
    public function saveTestResult()
    {
        $asset_id = Input::get('asset_id');
        $result   = Input::get('result');

        Result::updateOrCreate(
            ['asset_id' => $asset_id],
            ['result' => $result, 'user_id'  => Auth::user()->id]
        );

        return response()->json([
            "success" => true,
            "msg" => 'result saved',
            "data" => [
                 "user_id"  => Auth::user()->id,
                 "asset_id" => $asset_id,
                 "result"   => $result
            ]
        ]);
    }

    public function addToFavorite()
    {
        $word_id = Input::get('word_id');
        $translate_id = Input::get('translate_id');

        $asset_id =  Auth::user()->favourite->id;

        $card = new Card(['asset_id' => $asset_id, 'word_id' => $word_id, 'translate_id' => $translate_id]);

        if($card->save())
            return response()->json(['success' => true, 'card' => Card::with('word', 'translate')->where('id', $card->id)->get()[0]]);
        else
            return response()->json(['success' => false]);
    }

    public function deleteFavorite($id)
    {
        return response()->json([
            'success' => Card::whereRaw('word_id = ? and asset_id = ?', [$id, Auth::user()->favourite->id])->forceDelete()
        ]);
    }

    public function getFavorite()
    {
        return response()->json(Card::getCards(Auth::user()->favourite->id));
    }
}