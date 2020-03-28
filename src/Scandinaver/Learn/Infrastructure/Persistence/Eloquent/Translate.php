<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Eloquent;

use Eloquent;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, SoftDeletes};

/**
 * Class Translate
 *
 * @package App\Models
 * @property int    $id
 * @property string $value
 * @property int    $word_id
 * @property bool   $sentence
 * @mixin Eloquent
 */
class Translate extends Model
{
    use SoftDeletes;

    protected $table    = 'translate';

    protected $fillable = ['id', 'value', 'word_id', 'sentence'];

    protected $hidden   = ['created_at', 'updated_at', 'deleted_at', 'variant', 'form'];

    protected $appends  = ['active'];

    /**
     * @return BelongsTo|Word
     */
    public function word(): Word
    {
        return $this->belongsTo('App\Helpers\Eloquent\Word');
    }

    /**
     * @return bool
     */
    public function getActiveAttribute(): bool
    {
        return $this->attributes['active'] = false;
    }
}