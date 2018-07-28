<?php

namespace Application\Models;

use Eloquent;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.05.2016
 * Time: 18:21
 *
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $keywords
 */

class Meta extends Eloquent{

    protected $table = 'meta';

    protected $fillable = ['url', 'title', 'description', 'keywords'];
}