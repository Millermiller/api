<?php

namespace App\Http\Controllers\Sub\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Example;
use App\Models\Result;
use App\User;
use Illuminate\Support\Facades\Input;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 19.02.15
 * Time: 23:08
 *
 * Class ApiController
 * @package App\Http\Controllers\Sub\Frontend
 */
class ApiController extends Controller {

    private $id = null;

    public function assets($uid)
    {
        $assets = [];

        $activeArray = Result::where('user_id', $uid)->pluck('result', 'asset_id')->toArray();

        $personaldata = Asset::whereHas('result', function ($q) use ($uid) {
            $q->where('user_id', $uid);
        })->with('cards', 'cards.word', 'cards.translate', 'result')->get();

        $publicdata = Asset::with('cards', 'cards.word', 'cards.translate', 'result')->where('basic', 1)->get();

        $data = $personaldata->merge($publicdata);


        foreach($data as $item){
            $cards = [];

            foreach($item->cards as $card){
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
                'count'  => $item->cards->count(),
                'result' => 0,
                'level' => $item->level,
                'title' => $item->title,
                'type'  => $item->type,
                'basic' => $item->basic,
                'cards' => $cards
            ];

            $assets[] = $asset;
        }

        return response()->json($assets);
    }

    /**
     * Принять данные о новом юзере с главного сайта
     * Присвоить начальные basic наборы
     * TODO: обезопасить
     */
    public function setNewUser()
    {
        $uid = Input::get('uid');

        if(User::addUser($uid))
            echo 'success';
    }

    public function removeUser($id)
    {
        return response()->json(['success' =>  Result::where('user_id', '=', $id)->delete()]);
    }
} 