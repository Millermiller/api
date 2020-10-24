<?php


namespace Tests\Responses;


class User implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'login',
            'email',
            'active_to',
            'plan' => Plan::response(),
            'plan_id',
            'name',
            'photo',
            'assets_opened',
            'assets_created',
            'premium',
            'avatar',
        ];
    }
}