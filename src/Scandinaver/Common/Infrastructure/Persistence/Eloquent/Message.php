<?php


namespace Scandinaver\Common\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * Class Message
 *
 * @package Scandinaver\Common\Infrastructure\Persistence\Eloquent
 */
class Message extends Model
{

    use SoftDeletes;

    protected $table = 'messages';

    protected $fillable = ['name', 'message'];

}