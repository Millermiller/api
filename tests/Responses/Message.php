<?php


namespace Tests\Responses;


class Message implements ResponseInterface
{

    public static function singleResponse(): array
    {
        return [
            'id',
            'name',
            'message',
            'createdAt',
        ];
    }

    public static function collectionResponse(): array
    {
        // TODO: Implement collectionResponse() method.
    }
}