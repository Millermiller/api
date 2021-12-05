<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Category
 *
 * @package Tests\Responses
 */
class Category implements ResponseInterface
{

    #[ArrayShape(['data' => "array"])]
    public static function singleResponse(): array
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

    #[ArrayShape(['data' => "array[]"])]
    public static function collectionResponse(): array
    {
        return [
            'data' => [
                '*' => [
                    'type',
                    'id',
                    'attributes' => [
                        'title',
                    ],
                ],
            ],
        ];
    }
}