<?php


namespace Scandinaver\Blog\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, SoftDeletes};
use Scandinaver\User\Infrastructure\Persistence\Eloquent\User;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.05.2016
 * Time: 1:50
 *
 * @property int $id
 * @property int $post_id
 * @property string $text
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
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