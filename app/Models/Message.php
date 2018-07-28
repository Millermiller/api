<?php

namespace Application\Models;

use Eloquent;
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
class Message extends Eloquent
{
    protected $table = 'messages';

    protected $fillable = ['name', 'contact', 'message'];

    use SoftDeletes;
}