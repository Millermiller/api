<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Card
 *
 * @package Tests\Responses
 */
class Card implements ResponseInterface
{

    public static function singleResponse(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes'    => [
                    'favourite',
                ],
                'relationships' => [
                    'term' => [
                        'data' => [
                            'id',
                            'type',
                        ],
                    ],
                    'translate'    => [
                        'data' => [
                            'id',
                            'type',
                        ],
                    ],
                    'example' => [
                        'data' => [
                            '*' => [
                                'id',
                                'type',
                            ],
                        ],
                    ]
                ],
            ],
        ];
    }

    public static function collectionResponse(): array
    {
        // TODO: Implement collectionResponse() method.
    }
}