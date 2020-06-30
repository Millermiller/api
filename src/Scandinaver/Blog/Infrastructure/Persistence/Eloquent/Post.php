<?php


namespace Scandinaver\Blog\Infrastructure\Persistence\Eloquent;

use Exception;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Relations\HasMany, SoftDeletes};

/**
 * Class Post
 *
 * @package Scandinaver\Blog\Infrastructure\Persistence\Eloquent
 */
class Post extends Model
{
    use SoftDeletes;

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 0;

    protected $table    = 'posts';

    protected $fillable = ['title', 'post_author', 'content', 'category_id', 'anonse', 'status'];

    protected $dates    = ['deleted_at'];

    /**
     * @return bool
     * @throws Exception
     */
    public function delete(): bool
    {
        if (parent::delete()) {
            $this->comments()->delete();
        }
        return true;
    }

    /**
     * @return HasMany|Comment[]
     */
    public function comments(): array
    {
        return $this->hasMany('Scandinaver\Blog\Infrastructure\Persistence\Eloquent\Comment');
    }

    /**
     * @return BelongsTo|Category
     */
    public function category(): Category
    {
        return $this->belongsTo('Scandinaver\Blog\Infrastructure\Persistence\Eloquent\Category');
    }
}