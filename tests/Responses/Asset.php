<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Asset
 *
 * @package Tests\Responses
 */
class Asset implements ResponseInterface
{

    #[ArrayShape(['data' => "array"])]
    public static function singleResponse(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes'    => [
                    'title',
                    'level',
                    'count',
                ],
                'relationships' => [
                    'language' => [
                        'data' => [
                            'id',
                            'type',
                        ],
                    ],
                    'cards'    => [
                        'data' => [
                            '*' => [
                                'id',
                                'type',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    #[ArrayShape(['data' => "array"])]
    public static function singleResponseWithoutCards(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes'    => [
                    'title',
                    'level',
                    'count',
                ],
                'relationships' => [
                    'language' => [
                        'data' => [
                            'id',
                            'type',
                        ],
                    ],
                ],
            ],
        ];
    }

    #[ArrayShape(['data' => "array[]"])]
    public static function responseWithoutCards(): array
    {
        return [
            'data' => [
                '*' => [
                    'id',
                    'type',
                    'attributes'    => [
                        'category',
                        'title',
                        'level',
                        'count',
                    ],
                    'relationships' => [
                        'language' => [
                            'data' => [
                                'id',
                                'type',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function collectionResponse(): array
    {
        // TODO: Implement collectionResponse() method.
    }
}