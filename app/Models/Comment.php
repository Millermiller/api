<?php

namespace Application\Models;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

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

class Comment extends Eloquent{

    Use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'comments';

    public function author()
    {
        return $this->belongsTo('Application\Models\User');
    }

    public function post()
    {
        return $this->belongsTo('Application\Models\Post');
    }
}