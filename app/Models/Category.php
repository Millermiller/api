<?php

/**
 * Class Category
 * @package Application\Models
 */

namespace Application\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

class Category extends  Eloquent{

    protected $table = 'categories';

    protected $fillable = ['name'];

    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function posts()
    {
        return $this->hasMany('Application\Models\Post');
    }
}