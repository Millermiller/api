<?php


namespace Tests\Responses;


class Role implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'name',
            'slug',
            'description',
            'permissions'
        ];
    }
}