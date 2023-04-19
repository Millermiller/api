<?php


namespace Tests\Responses;

/**
 * Class Passing
 *
 * @package Tests\Responses
 */
class Passing implements ResponseInterface
{

    public static function singleResponse(): array
    {
        return [
            'data' => [
                'type',
                'id',
                'attributes'    => [
                    'percent',
                    'completed',
                    'time',
                    'errors',
                ],
                'relationships' => [
                    'user'  => [
                        'data' => [
                            'id',
                            'type',
                        ],
                    ],
                    'asset' => [
                        'data' => [
                            'id',
                            'type',
                        ],
                    ],
                ],
            ],
        ];
    }

    public static function collectionResponse(): array
    {
        return [
            'data' => [
                '*' => [
                    'type',
                    'id',
                    'attributes'    => [
                        'percent',
                        'completed',
                        'time',
                        'errors',
                    ],
                    'relationships' => [
                        'user'  => [
                            'data' => [
                                'id',
                                'type',
                            ],
                        ],
                        'asset' => [
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
}