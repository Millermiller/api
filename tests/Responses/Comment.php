<?php


namespace Tests\Responses;


use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Comment
 *
 * @package Tests\Responses
 */
class Comment implements ResponseInterface
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
                'attributes' => [
                    'text',
                ],
                "relationships" => [
                    "user" => [
                        "data" => [
                            "type",
                            "id",
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
                    'attributes' => [
                        'text',
                    ],
                    "relationships" => [
                        "user" => [
                            "data" => [
                                "type",
                                "id",
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}