<?php


namespace Scandinaver\Learning\Asset\Infrastructure\Persistence\Eloquent;

use Eloquent;
use Illuminate\Database\Eloquent\{Builder, Model, Relations\HasOne};

/**
 * Class Result
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Eloquent
 * @mixin Eloquent
 */
class Result extends Model
{

    protected $table = 'assets_users';

    protected $fillable = ['asset_id', 'user_id', 'result', 'language_id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @param  Builder  $query
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
        return $this->hasOne(
            'Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Asset',
            'id',
            'asset_id'
        );
    }

}