<?php


namespace Tests\Responses;

/**
 * Class Post
 *
 * @package Tests\Responses
 */
class Post implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'title',
            'content',
            'user'     => User::response(),
            'views',
            'category' => Category::response(),
            'comments',
            'status',
            'comment_status',
            'created_at',
        ];
    }
}