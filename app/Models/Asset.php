<?php

namespace App\Models;

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
        return $this->belongsTo('App\Models\Result', 'id', 'asset_id');
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
}