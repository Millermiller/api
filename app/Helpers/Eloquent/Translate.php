<?php

namespace App\Helpers\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;

/**
 * Class Translate
 * @package App\Models
 *
 * @property int $id
 * @property string $value
 * @property int $word_id
 * @property bool $sentence
 */
class Translate extends Model
{
    use SoftDeletes;

    protected $table = 'translate';

    protected $fillable = ['id', 'value', 'word_id', 'sentence'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'variant', 'form'];

    protected $appends = ['active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word()
    {
        return $this->belongsTo('App\Helpers\Eloquent\Word');
    }

    public function getActiveAttribute()
    {
        return $this->attributes['active'] = false;
    }
}