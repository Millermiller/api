<?php

namespace App\Helpers\Eloquent;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

class Post extends Model{

    protected $table = 'posts';

    protected $fillable = ['title', 'post_author', 'content', 'category_id', 'anonse', 'status'];

    Use SoftDeletes;

    protected $dates = ['deleted_at'];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function delete()
    {
        if(parent::delete()){
           $this->comments()->delete();
        }
        return true;
    }

    public function category()
    {
        return $this->belongsTo('App\Helpers\Eloquent\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Helpers\Eloquent\Comment');
    }
}