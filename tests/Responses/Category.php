<?php


namespace Tests\Responses;


class Category implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'name',
        ];
    }
}