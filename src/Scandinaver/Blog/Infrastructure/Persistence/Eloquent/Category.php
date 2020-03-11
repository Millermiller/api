<?php

namespace Scandinaver\Blog\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package Application\Models
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function posts()
    {
        return $this->hasMany('App\Helpers\Eloquent\Post');
    }
}