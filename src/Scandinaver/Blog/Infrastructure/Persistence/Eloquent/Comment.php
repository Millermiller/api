<?php


namespace Scandinaver\Blog\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, SoftDeletes};
use Scandinaver\User\Infrastructure\Persistence\Eloquent\User;

/**
 * Class Comment
 *
 * @package Scandinaver\Blog\Infrastructure\Persistence\Eloquent
 */
class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'comments';

    /**
     * @return BelongsTo|User
     */
    public function author(): User
    {
        return $this->belongsTo('Application\Models\User');
    }

    /**
     * @return BelongsTo|Post
     */
    public function post(): Post
    {
        return $this->belongsTo('Application\Models\Post');
    }
}