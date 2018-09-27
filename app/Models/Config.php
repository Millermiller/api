<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: whiskey
 * Date: 29.11.14
 * Time: 19:00
 *
 *  Class Config
 * @package Application\Models
 */

class Config extends Model{

    protected $table = 'config';
    protected $fillable  = ['id', 'name', 'value'];

    public function __get($name)
    {
        // TODO: Implement __get() method.
    }
}