<?php


namespace Scandinaver\Blog\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Model, Relations\HasMany, SoftDeletes};

/**
 * Class Category
 *
 * @package Scandinaver\Blog\Infrastructure\Persistence\Eloquent
 */
class Category extends Model
{
    use SoftDeletes;

    public    $timestamps = true;

    protected $table      = 'categories';

    protected $fillable   = ['name'];

    protected $dates      = ['deleted_at'];

    /**
     * @return HasMany|Post[]
     */
    public function posts(): array
    {
        return $this->hasMany('App\Helpers\Eloquent\Post');
    }
}