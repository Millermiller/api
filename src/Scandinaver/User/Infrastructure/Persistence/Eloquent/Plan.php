<?php


namespace Scandinaver\User\Infrastructure\Persistence\Eloquent;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Plan
 *
 * @package Scandinaver\User\Infrastructure\Persistence\Eloquent
 * @mixin Eloquent
 */
class Plan extends Model
{

    public $timestamps = false;

    protected $table = 'plans';

    protected $casts = [
        'cost' => 'int',
        'cost_per_month' => 'int',
    ];

    protected $fillable = [
        'name',
        'period',
        'cost',
        'cost_per_month',
    ];

}