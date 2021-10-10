<?php


namespace Tests\Responses;

/**
 * Class Passing
 *
 * @package Tests\Responses
 */
class Passing implements ResponseInterface
{

    public static function response(): array
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
}