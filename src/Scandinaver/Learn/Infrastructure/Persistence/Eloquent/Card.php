<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Eloquent;

use Eloquent;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Relations\HasMany, SoftDeletes};

/**
 * Class Card
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Eloquent
 * @mixin Eloquent
 */
class Card extends Model
{

    use SoftDeletes;

    protected $table = 'card';

    protected $fillable = ['asset_id', 'word_id', 'translate_id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

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
     * @return BelongsTo|Translate
     */
    public function translate(): Translate
    {
        return $this->belongsTo(
            'Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Translate'
        );
    }

    /**
     * @return BelongsTo|Asset
     */
    public function asset(): Asset
    {
        return $this->belongsTo(
            'Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Asset'
        );
    }

    /**
     * @return HasMany|Example[]
     */
    public function examples(): array
    {
        return $this->hasMany(
            'Scandinaver\Learn\Infrastructure\Persistence\Eloquent\Example'
        );
    }

}