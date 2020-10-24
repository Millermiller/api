<?php


namespace Tests\Responses;


class Plan implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'name',
            'period',
            'cost',
        ];
    }
}