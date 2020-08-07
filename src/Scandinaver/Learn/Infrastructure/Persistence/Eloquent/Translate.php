<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Eloquent;

use Eloquent;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, SoftDeletes};

/**
 * Class Translate
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Eloquent
 * @mixin Eloquent
 */
class Translate extends Model
{

    use SoftDeletes;

    protected $table = 'translate';

    protected $fillable = ['id', 'value', 'word_id', 'sentence'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'variant',
        'form',
    ];

    protected $appends = ['active'];

    /**
     * @return BelongsTo|Word
     */
    public function word(): Word
    {
        return $this->belongsTo(
            'Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Word'
        );
    }

    /**
     * @return bool
     */
    public function getActiveAttribute(): bool
    {
        return $this->attributes['active'] = false;
    }

}