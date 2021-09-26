<?php


namespace Tests\Responses;

/**
 * Class UserWithRBAC
 *
 * @package Tests\Responses
 */
class UserWithRBAC implements ResponseInterface
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
            'permissions',

        ];
    }
}