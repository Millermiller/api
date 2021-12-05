<?php


namespace Tests\Responses;

/**
 * Class UserWithRBAC
 *
 * @package Tests\Responses
 */
class UserWithRBAC implements ResponseInterface
{

    public static function singleResponse(): array
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

    public static function collectionResponse(): array
    {
        // TODO: Implement collectionResponse() method.
    }
}