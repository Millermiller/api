<?php


namespace Scandinaver\Blog\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Relations\HasMany, SoftDeletes, Model};

/**
 * Class Category
 * @package Application\Models
 */
class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = ['name'];

    public $timestamps = true;

    protected $dates = ['deleted_at'];

    /**
     * @return HasMany|Post[]
     */
    public function posts(): array
    {
        return $this->hasMany('App\Helpers\Eloquent\Post');
    }
}