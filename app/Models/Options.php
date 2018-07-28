<?php

namespace Application\Models;

use Eloquent;

class Options extends Eloquent{

    protected $table = 'options';
    protected $fillable  = ['id', 'name', 'value', 'type'];

    public function __get($name)
    {
       return self::where('name', $name)->first()->toArray()['value'];
    }
}