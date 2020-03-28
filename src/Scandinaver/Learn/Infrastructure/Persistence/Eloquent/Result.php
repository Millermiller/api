<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Eloquent;

use Eloquent;
use Illuminate\Database\Eloquent\{Builder, Model, Relations\HasOne};

/**
 * Class Result
 *
 * @package App\Models
 * @property int   id
 * @property int   asset_id
 * @property int   user_id
 * @property int   result
 * @property Asset asset
 * @mixin Eloquent
 * @method static Builder domain()
 */
class Result extends Model
{
    protected $table    = 'assets_users';

    protected $fillable = ['asset_id', 'user_id', 'result', 'language_id'];

    protected $hidden   = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function scopeDomain(Builder $query): Builder
    {
        return $query->where('language_id', config('app.lang'));
    }

    /**
     * @return HasOne|Asset
     */
    public function asset(): Asset
    {
        return $this->hasOne('App\Helpers\Eloquent\Asset', 'id', 'asset_id');
    }
}