<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Role
 *
 * @package Tests\Responses
 */
class Role implements ResponseInterface
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
                    "permissions" => [
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

    #[ArrayShape(['data' => "array[]"])]
    public static function collectionResponse(): array
    {
        return [
            'data' => [
                '*' => [
                    'id',
                    'type',
                    'attributes'    => [
                        'name',
                        'slug',
                        'description',
                    ],
                    'relationships' => [
                        'permissions' => [
                            'data' => [
                                '*' => [
                                    'id',
                                    'type',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}