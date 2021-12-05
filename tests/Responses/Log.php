<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Log
 *
 * @package Tests\Responses
 */
class Log implements ResponseInterface
{

    #[ArrayShape([
        'data'     => "array",
        'included' => "\string[][]",
    ])]
    public static function singleResponse(): array
    {
        return [
            'data'     => [
                'id',
                'type',
                'attributes'    => [
                    'message',
                    'level',
                    'extra',
                    'created_at',
                ],
                "relationships" => [
                    "owner" => [
                        "data" => [
                            "type",
                            "id",
                        ],
                    ],
                ],
            ],
            'included' => [
                '*' => [
                    'type',
                    'id',
                    'attributes',
                ],
            ],
        ];
    }

    #[ArrayShape(['data' => "array[]", 'included' => "\string[][]"])]
    public static function collectionResponse(): array
    {
        return [
            'data' => [
                '*' => [
                    'id',
                    'type',
                    'attributes'    => [
                        'message',
                        'level',
                        'extra',
                        'created_at',
                    ],
                    "relationships" => [
                        "owner" => [
                            "data" => [
                                "type",
                                "id",
                            ],
                        ],
                    ],
                ],
            ],
            'included' => [
                '*' => [
                    'type',
                    'id',
                    'attributes',
                ],
            ],
        ];
    }
}