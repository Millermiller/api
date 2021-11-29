<?php


namespace Tests\Responses;

/**
 * Class Category
 *
 * @package Tests\Responses
 */
class Category implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'data' => [
                'type',
                'id',
                'attributes' => [
                    'title'
                ]
            ],
        ];
    }
}