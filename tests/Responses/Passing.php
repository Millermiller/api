<?php


namespace Tests\Responses;

/**
 * Class Passing
 *
 * @package Tests\Responses
 */
class Passing implements ResponseInterface
{

    public static function singleResponse(): array
    {
        return [
            'id',
            'percent',
            'completed',
            'time',
            'errors',
            'user' => User::response(),
            'asset' => Asset::responseWithoutCards()
        ];
    }

    public static function collectionResponse(): array
    {
        // TODO: Implement collectionResponse() method.
    }
}