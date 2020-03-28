<?php


namespace Scandinaver\Text\Infrastructure\Persistence\Eloquent;

use Eloquent;
use Illuminate\Database\Eloquent\{Builder, Model, Relations\HasOne};

/**
 * Class TextResult
 *
 * @package App\Models
 * Created by PhpStorm.
 * User: Миллер
 * Date: 24.05.2017
 * Time: 20:55
 * @property int  $id
 * @property int  $text_id
 * @property int  $user_id
 * @property Text $text
 * @method static Builder domain()
 * @mixin Eloquent
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
        return $this->hasOne('App\Helpers\Eloquent\Text', 'id', 'text_id');
    }
}