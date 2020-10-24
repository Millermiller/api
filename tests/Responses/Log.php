<?php


namespace Tests\Responses;


class Log implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'message',
            'owner',
            'level',
            'extra',
            'created_at',
        ];
    }
}