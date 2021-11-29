<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Post
 *
 * @package Tests\Responses
 */
class Post implements ResponseInterface
{

    #[ArrayShape([
        'data'     => "array",
        'included' => "\string[][]",
    ])]
    public static function response(): array
    {
        return [
            'data'     => [
                'type',
                'id',
                'attributes'    => [
                    'title',
                    'content',
                    'views',
                    'status',
                    'comment_status',
                    'created_at',
                ],
                'relationships' => [
                    'user' => [
                        'data' => [
                            "type",
                            "id",
                        ],
                    ],
                    'category' => [
                        'data' => [
                            "type",
                            "id",
                        ],
                    ],
                    'comments' => [
                        'data' => [
                            '*' => [
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