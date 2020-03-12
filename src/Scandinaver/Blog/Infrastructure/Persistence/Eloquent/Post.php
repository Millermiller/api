<?php


namespace Scandinaver\Blog\Infrastructure\Persistence\Eloquent;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Relations\HasMany, SoftDeletes};

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.05.2016
 * Time: 18:10
 *
 * @property int $id
 * @property string $title
 * @property string $post_author
 * @property string $content
 * @property int $category_id
 * @property string $anonse
 * @property string $post_status
 * @property int $status
 * @property int $views
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Post extends Model
{
    use SoftDeletes;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $table = 'posts';

    protected $fillable = ['title', 'post_author', 'content', 'category_id', 'anonse', 'status'];

    protected $dates = ['deleted_at'];

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
     * @return BelongsTo|Category
     */
    public function category(): Category
    {
        return $this->belongsTo('App\Helpers\Eloquent\Category');
    }

    /**
     * @return HasMany|Comment[]
     */
    public function comments(): array
    {
        return $this->hasMany('App\Helpers\Eloquent\Comment');
    }
}