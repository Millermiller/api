<?php


namespace Tests\Responses;


class PermissionGroup implements ResponseInterface
{

    public static function response(): array
    {
        return [
            "id",
            "name",
            "slug",
            "description",
        ];
    }

}