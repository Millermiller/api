<?php


namespace Tests\Responses;

/**
 * Class User
 *
 * @package Tests\Responses
 */
class User implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'login',
            'avatar',
            'email',
            'active',
            'active_to'
        ];
    }
}