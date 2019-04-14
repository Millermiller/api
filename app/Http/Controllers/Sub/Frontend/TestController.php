<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Events\NextLevel;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Card;
use App\Models\Result;
use App\Services\CardService;
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
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAsset($id)
    {
        $cards = $this->cardService->getCards($id);

        return response()->json($cards);
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
            $result = new Result(['asset_id' => $next_asset_id, 'user_id' => Auth::user()->id, 'lang' => config('app.lang')]);

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
            ['asset_id' => $asset_id, 'user_id'  => Auth::user()->id, 'lang' => config('app.lang')],
            ['result' => $result, 'user_id'  => Auth::user()->id, 'lang' => config('app.lang')]
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
}