<?php


namespace Tests\Responses;

/**
 * Class Asset
 *
 * @package Tests\Responses
 */
class Asset implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'title',
                'level',
                'count',
                'language',
                'cards' => [
                    Card::response()
                ],
            ]
        ];
    }

    public static function responseWithoutCards(): array
    {
        return [
            'id',
            'type',
            'title',
            'level',
            'count',
            'language',
        ];
    }
}