<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

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