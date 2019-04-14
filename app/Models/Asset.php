<?php

namespace App\Models;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.09.2016
 * Time: 7:30
 *
 * Class Asset
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $lang
 * @property bool $basic
 * @property int $level
 * @property int $type
 * @property bool $favorite
 *
 * @property Card cards
 * @property Result result
 *
 * @method static Builder domain()
 */
class Asset extends Model
{
    const TYPE_PERSONAL = 0;
    const TYPE_WORDS = 1;
    const TYPE_SENTENCES = 2;
    const TYPE_FAVORITES = 3;

    use SoftDeletes;

    protected $table = 'assets';

    protected $fillable = ['title', 'basic', 'favorite', 'type', 'level', 'lang'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeDomain($query)
    {
        return $query->where('lang',  config('app.lang'));
    }

    /**
     * @return Card|\Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    /**
     * @return Result|\Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function result()
    {
        return $this->belongsTo('App\Models\Result', 'id', 'asset_id')->where('user_id', \Auth::id());
    }

  // public function user()
  // {
  //     return $this->belongsTo('App\Models\User', 'role_user', 'user_id', 'role_id');
  // }

    /**
     * @param int $uid User Id
     * @return array
     */
    static function getUserAssets($uid)
    {
        return DB::select(
            'select a.id, a.title, a.basic, a.level, a.favorite, 
		            atu.result, count(wta.id) as count
              from assets_to_users as atu
                join assets as a
                  on atu.asset_id = a.id
         	    left join cards as wta
         		  on wta.asset_id = a.id
                where atu.user_id = ?
                  and a.basic = 0
                group by a.id
                order by a.favorite desc', [$uid]
        );
    }

    /**
     * Удаляет набор и все с ним связанное
     * TODO: объединить запрос. использовать внешние ключи.
     *
     * @param  int $id Asset Id
     * @return bool
     * @throws \Exception
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
                       lang = ?,
                       created_at = NOW(),
                       updated_at = NOW(),
                       level = (select max(a2.level)
                                    from assets as a2
                                        where a2.type = ?
                                        and a2.lang = ?) + 1
                   ', [$asset_id, $asset_id,  config('app.lang'), $asset_id,  config('app.lang')]);


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

            if($counter < 10 || Auth::user()->premium)
                $r['available'] = true;
            else
                $r['available'] = false;

            $testlink = $r['id'];
        }

        return $rez;
    }
}