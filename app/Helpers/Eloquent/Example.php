<?php

namespace App\Helpers\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Example
 * @package App\Models
 *
 * @property int id
 * @property int card_id
 * @property string text
 * @property string value
 */
class Example extends Model
{
    use SoftDeletes;

    protected $table = 'examples';

    protected $fillable = ['card_id', 'text', 'value'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}