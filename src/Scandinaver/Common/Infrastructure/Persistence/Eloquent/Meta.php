<?php


namespace Scandinaver\Common\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Meta
 *
 * @package Scandinaver\Common\Infrastructure\Persistence\Eloquent
 */
class Meta extends Model
{

    protected $table = 'meta';

    protected $fillable = ['url', 'title', 'description', 'keywords'];

}