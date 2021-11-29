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
    public static function response(): array
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
}