<?php


namespace Scandinaver\Learn\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * Class Example
 *
 * @package Scandinaver\Learn\Infrastructure\Persistence\Eloquent
 */
class Example extends Model
{
    use SoftDeletes;

    protected $table    = 'examples';

    protected $fillable = ['card_id', 'text', 'value'];

    protected $hidden   = ['created_at', 'updated_at', 'deleted_at'];
}