<?php


namespace Scandinaver\Learning\Translate\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TextExtra
 *
 * @package Scandinaver\Translate\Infrastructure\Persistence\Eloquent
 */
class TextExtra extends Model
{

    protected $table = 'text_extras';

    protected $fillable = ['text_id', 'orig', 'extra'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return BelongsTo|Text
     */
    public function text(): Text
    {
        return $this->belongsTo(
            'Scandinaver\Translate\Infrastructure\Persistence\Eloquent\Text'
        );
    }

}