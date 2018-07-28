<?php

namespace Application\Models;

use Carbon\Carbon;
use Eloquent;

/**
 * Class Log
 * @package Application\models
 *
 * Created by PhpStorm.
 * User: user
 * Date: 28.08.2016
 * Time: 0:22
 *
 * @property int $id
 * @property string $message
 * @property string $type
 * @property int $created_at
 * @property int $updated_at
 */
class Log extends Eloquent
{
    protected $table = 'log';

    protected $fillable = ['message', 'type'];

    protected $appends = ['hours'];

    public function getHoursAttribute() {
        return  Carbon::now()->diffInHours($this->created_at);
    }
}