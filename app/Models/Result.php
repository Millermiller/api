<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Result
 * @package App\Models
 *
 * @property int id
 * @property int asset_id
 * @property int user_id
 * @property int result
 *
 * @property Asset asset
 *
 * @method static Builder domain()
 */
class Result extends Model
{
    protected $table = 'assets_to_users';

    protected $fillable = ['asset_id', 'user_id', 'result'];

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
     * @return Asset|\Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function asset()
   {
       return $this->hasOne('App\Models\Asset', 'id', 'asset_id');
   }
}