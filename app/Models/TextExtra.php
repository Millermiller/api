<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TextExtra
 * @package App\Models
 *
 * Created by PhpStorm.
 * User: user
 * Date: 07.09.2016
 * Time: 22:54
 *
 * @property int $id
 * @property int $text_id
 * @property string $orig
 * @property string $extra
 */
class TextExtra extends Model
{
    protected $table = 'text_extras';

    protected $fillable = ['text_id', 'orig','extra'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function text()
    {
        return $this->belongsTo('App\Models\Text');
    }
}