<?php


namespace Scandinaver\Text\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class TextWord
 * @package App\Models
 *
 * Created by PhpStorm.
 * User: user
 * Date: 20.10.2016
 * Time: 6:19
 *
 * @property int $text_id
 * @property int $sentence_num
 * @property string $word
 * @property string $orig
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
        return $this->hasMany('App\Helpers\Eloquent\Synonym');
    }
}