<?php

namespace App\Services;

use App\Http\Requests\CreateCardRequest;
use App\Models\Card;
use App\Models\Example;
use Auth;
use DB;

/**
 * Class CardService
 * @package app\Services
 */
class CardService
{
    public function create(CreateCardRequest $request)
    {
        $card = Card::create($request->all());

        $card->load(['word', 'translate', 'asset', 'examples']);

        return $card;
    }

    /**
     * возвращает слова набора, транскрипцию и один вариант перевода
     * принимает id набора
     *
     * используется  при редактировании набора на /cards/
     * @param  int $asset_id Asset Id
     * @return array
     */
    public function getCards($asset_id)
    {
        if(!Auth::user()->hasAsset($asset_id) && !Auth::user()->isAdmin()){
            return ['success' => false, 'message' => 'Этот словарь недоступен'];
        }




        $favourites = DB::table('cards')->where('asset_id', Auth::user()->favourite->id)->pluck('word_id')->toArray();

        $type = DB::table('assets')->where('id', $asset_id)->value('type');
        $title = DB::table('assets')->where('id', $asset_id)->value('title');

        $cards = Card::with(['word', 'translate', 'asset', 'examples'])->where('asset_id', $asset_id)->get();

        foreach($cards as &$c){
            if(in_array($c->id, $favourites))
                $c->favourite = true;
            else
                $c->favourite = false;
        }

        return ['type' => $type, 'cards' => $cards, 'title' => $title];
    }
}