<?php


namespace Tests\Responses;


class Plan implements ResponseInterface
{

    public static function singleResponse(): array
    {
        return [
            'id',
            'name',
            'period',
            'cost',
        ];
    }

    public static function collectionResponse(): array
    {
        // TODO: Implement collectionResponse() method.
    }
}