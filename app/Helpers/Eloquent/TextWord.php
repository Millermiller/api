<?php

namespace App\Helpers\Eloquent;

use Illuminate\Database\Eloquent\Model;

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
    protected $table = 'word_in_text';

    protected $fillable = ['text_id', 'sentence_num', 'word', 'orig'];

    public function synonyms()
    {
        return $this->hasMany('App\Helpers\Eloquent\Synonym');
    }
}