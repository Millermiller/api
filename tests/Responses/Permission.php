<?php


namespace Tests\Responses;


class Permission implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'name',
            'slug',
            'description',
            'group' => PermissionGroup::response()
        ];
    }
}