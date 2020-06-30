<?php


namespace Scandinaver\Translate\Infrastructure\Persistence\Eloquent;

use Eloquent;
use Illuminate\Database\Eloquent\{Builder, Model, Relations\HasOne};

/**
 * Class TextResult
 *
 * @package Scandinaver\Translate\Infrastructure\Persistence\Eloquent
 * @mixin Eloquent
 * @method static Builder domain()
 */
class TextResult extends Model
{
    protected $table    = 'texts_to_users';

    protected $fillable = ['text_id', 'user_id', 'language_id'];

    protected $hidden   = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeDomain(Builder $query): Builder
    {
        return $query->where('language_id', config('app.lang'));
    }

    /**
     * @return HasOne|Text
     */
    public function text(): Text
    {
        return $this->hasOne('Scandinaver\Translate\Infrastructure\Persistence\Eloquent\Text', 'id', 'text_id');
    }
}