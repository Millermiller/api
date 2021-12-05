<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Setting
 *
 * @package Tests\Responses
 */
class Setting implements ResponseInterface
{

    #[ArrayShape(['data' => "array"])]
    public static function singleResponse(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes' => [
                    'title',
                    'slug',
                    'type',
                    'value',
                ]
            ]
        ];
    }

    #[ArrayShape(['data' => "array[]"])]
    public static function collectionResponse(): array
    {
        return [
            'data' => [
                '*' =>
                    [
                        'id',
                        'type',
                        'attributes' => [
                            'title',
                            'slug',
                            'type',
                            'value',
                        ],
                    ],
            ],
        ];
    }
}