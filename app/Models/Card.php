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
     * Получить наборы карточек для юзера
     *
     * @param  int $user_id int User Id
     * @return array
     */
    public static function getAssets($user_id)
    {
        return DB::select('
                                 SELECT COUNT(wta.word_id) as num, a.title, a.id, a.basic, a.level, atu.result
                                 FROM assets AS a
                                 LEFT JOIN assets_to_users as atu
                                    ON a.id = atu.asset_id
                                 LEFT JOIN cards AS wta
                                    ON a.id = wta.asset_id
                                 WHERE user_id = ?
                                -- AND a.basic IN(1)
                                 GROUP BY a.id
                                 ORDER BY a.level
                                 ', [$user_id]);
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
                        SELECT DISTINCT wta.id as card_id, t.id as translate_id,  w.id, w.word, w.transcription, t.value, w.audio, w.creator 
                        FROM assets as a

                        JOIN cards as wta
                          ON  wta.asset_id = a.id

                        JOIN words as w
                          ON w.id = wta.word_id

                        JOIN translate as t
                          ON t.id = wta.translate_id

                        WHERE a.id = ?
                          AND a.lang = ?

                        ', [$asset_id, config('app.lang')]);


        $favourites = DB::table('cards')->where('asset_id', Auth::user()->favourite_id)->pluck('word_id')->toArray();
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

    /**
     * Удаляет набор и все с ним связанное
     * TODO: объединить запрос. использовать внешние ключи.
     *
     * @param  int $id Asset Id
     * @return bool
     */
    public static function deleteAsset($id)
    {
        if(!Auth::user()->hasAsset($id) && !Auth::user()->_admin)
            return false;

        DB::beginTransaction();

        try {
                DB::delete('DELETE FROM assets WHERE id = ?', [$id]);

                DB::delete('DELETE FROM cards WHERE asset_id = ?', [$id]);

                DB::delete('DELETE FROM assets_to_users WHERE asset_id = ?', [$id]);

                DB::commit();

                return true;
            }
            catch(\Exception $e){

                DB::rollback();

                return false;
            }
    }

    /**
     * @param $user_id
     * @param $asset_title
     * @return Asset | bool
     */
    public static function createAsset($user_id, $asset_title)
    {
        DB::beginTransaction();

        try{
            $asset = Asset::create([
                'title' => $asset_title,
                'basic' => false,
                'level' => 0
            ]);

            DB::insert('
                        INSERT INTO assets_to_users
                        SET asset_id = ?,
                            user_id  = ?', [$asset->id, $user_id]);

            DB::commit();

            return $asset;
        }
        catch(\Exception $e){

            DB::rollBack();

            return false;
        }
    }

    /**
     * Проверяет наличие следующего уровня basic-набора
     * Возвращает его id или false если не находит
     * TODO: сократить вложенные запросы
     * @param  int $asset_id Asset Id
     *
     * @return int
     */
    public static function getNextLevel($asset_id)
    {
        return DB::select('
                   SELECT id
                   FROM assets as a
                   WHERE a.basic = 1
                   AND a.type = (SELECT a1.type from assets as a1 where a1.id = ?)
                   AND a.level = (SELECT a1.level from assets as a1 where a1.id = ?) + 1
                   ', [$asset_id, $asset_id])[0];
    }

    /**
     * Добавляет basic набор следующего уровня
     * возвращает инфу о новом наборе
     * @param $asset_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public static function addLevel($asset_id)
    {
       DB::insert('
                   INSERT INTO assets
                   SET title = ?,
                       basic = 1,
                       type = ?,
                       created_at = NOW(),
                       updated_at = NOW(),
                       level = (select max(a2.level)
                               from assets as a2
                               where a2.type = ?) + 1
                   ', [$asset_id, $asset_id, $asset_id]);


        return Asset::find(DB::getPdo()->lastInsertId());
    }

    /**
     * Возвращает массив словарей определенного типа для пользователя с id = $uid
     *
     * @param string $type 'Предложения' || 'Слова' || 'Избранное'
     * @param int $uid User Id
     *
     * @return array
     */
    public static function getAssetsByType($type, $uid)
    {
        $activeArray = Result::domain()->where('user_id', $uid)->pluck('result', 'asset_id')->toArray();

        $rez = DB::select('SELECT id, level, title, type FROM assets WHERE type = ? AND lang = ? order by level asc', [$type, config('app.lang')]);

        $canopen = true;
        $testlink = 0;
        $counter = 0;

        foreach($rez as &$r) {
            $counter++;
            if (in_array($r->id, array_keys($activeArray))) {
                $r = ['count' => Card::where('asset_id', $r->id)->count(),
                    'title' => $r->title,
                    'id' => $r->id,
                    'level' => $r->level,
                    'active' => true,
                    'canopen' => false,
                    'result' => $activeArray[$r->id],
                    'type' => $r->type
                ];
            } else {
                $r = ['count' => Card::where('asset_id', $r->id)->count(),
                    'title' => $r->title,
                    'id' => $r->id,
                    'level' => $r->level,
                    'active' => false,
                    'canopen' => $canopen,
                    'testlink' => $testlink,
                    'result' => 0,
                    'type' => $r->type
                ];
                $canopen = false;
            }

            if($counter < 10 || Auth::user()->active)
                $r['available'] = true;
            else
                $r['available'] = false;

            $testlink = $r['id'];
        }

        return $rez;
    }
}