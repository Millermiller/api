<?php


namespace Tests\Responses;

/**
 * Class LogCollection
 *
 * @package Tests\Responses
 */
class LogCollection implements ResponseInterface
{

    public static function response(): array
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