<?php

namespace App\Helpers\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Message
 * @package Application\Models
 *
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $message
 * @property int $readed
 * @property int $created_at
 * @property int $updated_at
 */
class Message extends Model
{
    use SoftDeletes;

    protected $table = 'messages';

    protected $fillable = ['name', 'message'];

}