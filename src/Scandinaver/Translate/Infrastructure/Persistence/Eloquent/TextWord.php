<?php


namespace Scandinaver\Translate\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class TextWord
 *
 * @package Scandinaver\Translate\Infrastructure\Persistence\Eloquent
 */
class TextWord extends Model
{
    /**
     * @var string
     */
    protected $table = 'word_in_text';

    /**
     * @var array
     */
    protected $fillable = ['text_id', 'sentence_num', 'word', 'orig'];

    /**
     * @return HasMany|Synonym[]
     */
    public function synonyms(): array
    {
        return $this->hasMany('Scandinaver\Translate\Infrastructure\Persistence\Eloquent\Synonym');
    }
}