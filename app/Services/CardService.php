<?php

namespace App\Services;

use App\Models\Example;
use Auth;
use DB;

/**
 * Class CardService
 * @package app\Services
 */
class CardService
{
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

        $cards = DB::select('
                        SELECT DISTINCT wta.id as card_id, t.id as translate_id,  w.id, w.word, w.transcription, t.value, w.audio, w.creator, u.login as login
                        FROM assets as a

                        JOIN cards as wta
                          ON  wta.asset_id = a.id

                        JOIN words as w
                          ON w.id = wta.word_id

                        JOIN translate as t
                          ON t.id = wta.translate_id

                        left join users as u 
                            on u.id = w.creator
                                  
                        WHERE a.id = ?
                          AND a.lang = ?

                        ', [$asset_id, config('app.lang')]);


        $favourites = DB::table('cards')->where('asset_id', Auth::user()->favourite->id)->pluck('word_id')->toArray();
        $type = DB::table('assets')->where('id', $asset_id)->value('type');
        $title = DB::table('assets')->where('id', $asset_id)->value('title');

        foreach($cards as &$c){
            $c->examples = Example::where('card_id', '=', $c->card_id)->get();
            $c->value = preg_replace('/^(\d\\)\s)/', '', $c->value);
            if(in_array($c->id, $favourites))
                $c->favourite = true;
            else
                $c->favourite = false;
        }

        return ['type' => $type, 'cards' => $cards, 'title' => $title];
    }
}