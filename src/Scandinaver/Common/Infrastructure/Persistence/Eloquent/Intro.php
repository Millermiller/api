<?php


namespace Scandinaver\Common\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * Class Intro
 *
 * @package Scandinaver\Common\Infrastructure\Persistence\Eloquent
 */
class Intro extends Model
{

    use SoftDeletes;

    protected $table = 'intro';

    protected $fillable = [
        'page',
        'element',
        'intro',
        'sort',
        'position',
        'tooltipClass',
        'active',
    ];

}