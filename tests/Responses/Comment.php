<?php


namespace Tests\Responses;


/**
 * Class Comment
 *
 * @package Tests\Responses
 */
class Comment implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'text',
            'user' => User::response(),
        ];
    }
}