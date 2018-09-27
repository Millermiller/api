<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Options
 * @package App\Models
 */
class Options extends Model{

    protected $table = 'options';
    protected $fillable  = ['id', 'name', 'value', 'type'];

    public function __get($name)
    {
       return self::where('name', $name)->first()->toArray()['value'];
    }
}