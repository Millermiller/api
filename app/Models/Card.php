<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 28.01.15
 * Time: 23:36
 *
 * Class Card
 * @package App\Models
 *
 * @property int id
 * @property int asset_id
 * @property int word_id
 * @property int translate_id
 * @property int created_at
 * @property int updated_at
 * @property int deleted_at
 * @property Word word
 * @property Asset asset
 * @property Translate translate
 */
class Card extends Model{

    protected $table = 'cards';

    protected $fillable = ['asset_id', 'word_id', 'translate_id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    Use SoftDeletes;

    /**
     * @return Word | \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word()
    {
        return $this->belongsTo('App\Models\Word');
    }

    /**
     * @return Translate | \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translate()
    {
        return $this->belongsTo('App\Models\Translate');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo('App\Models\Asset');
    }

    public function examples()
    {
        return $this->hasMany('App\Models\Example');
    }

    /**
     * возвращает слова набора, транскрипцию и один вариант перевода
     * принимает id набора
     *
     * используется  при редактировании набора на /cards/
     * @param  int $asset_id Asset Id
     * @return array
     */
    public static function getCards($asset_id)
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