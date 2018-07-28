<?php

namespace Application\Models;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.05.2016
 * Time: 18:10
 *
 * @property int $id
 * @property string $post_name
 * @property string $post_author
 * @property int $post_date
 * @property string $post_content
 * @property int $category_id
 * @property string $post_anonse
 * @property string $post_status
 * @property string $comment_status
 * @property int $views
 */

class Post extends Eloquent{

    protected $table = 'posts';

    protected $fillable = ['post_name', 'post_author', 'post_content', 'category_id', 'post_anonse', 'post_status'];

    Use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function delete()
    {
        if(parent::delete()){
           $this->comments()->delete();
        }
        return true;
    }

    public function category()
    {
        return $this->belongsTo('Application\Models\Category');
    }

    public function comments()
    {
        return $this->hasMany('Application\Models\Comment');
    }
}