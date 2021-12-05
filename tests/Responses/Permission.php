<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Permission
 *
 * @package Tests\Responses
 */
class Permission implements ResponseInterface
{

    #[ArrayShape([
        'data' => "array",
    ])]
    public static function singleResponse(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes'    => [
                    'name',
                    'slug',
                    'description',
                ],
                "relationships" => [
                    "group" => [
                        "data" => [
                            "type",
                            "id",
                        ],
                    ],
                ],
            ],
        ];
    }

    #[ArrayShape(['data' => "array[]", 'included' => "array[]"])]
    public static function collectionResponse(): array
    {
        return [
            'data'     => [
                '*' => [
                    'id',
                    'type',
                    'attributes'    => [
                        'name',
                        'slug',
                        'description',
                    ],
                    'relationships' => [
                        'group' => [
                            'data' => [
                                'id',
                                'id',
                                'type',
                            ],
                        ],
                    ],
                ],
            ],
            'included' => [
                '*' => [
                    'type',
                    'id',
                    'attributes' => [
                        'name',
                        'slug',
                        'description',
                    ],
                ],
            ],
        ];
    }
}