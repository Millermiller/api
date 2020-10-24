<?php


namespace Tests\Responses;


class Message implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'name',
            'message',
            'createdAt',
        ];
    }
}