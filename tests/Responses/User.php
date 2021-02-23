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
            'active_to',
            // 'plan' => Plan::response(),
            // 'plan_id',
            // 'name',
            // 'photo',
            // 'assets_opened',
            // 'assets_created',
            'roles',
            'permissions'

        ];
    }
}