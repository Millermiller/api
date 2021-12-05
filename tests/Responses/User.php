<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class User
 *
 * @package Tests\Responses
 */
class User implements ResponseInterface
{

    #[ArrayShape(['data' => "array"])]
    public static function singleResponse(): array
    {
        return [
            'data' => [
                'id',
                'type',
                'attributes'    => [
                    'login',
                    'email',
                    'active',
                    'active_to',
                    'permissionsSimple',
                    'avatar',
                ],
                // 'relationships' => [
                //     'roles' => [
                //         'data' => [
                //             '*' => [
                //                 'id',
                //                 'type',
                //             ],
                //         ],
                //     ],
                // ],
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
                        'login',
                        'email',
                        'active',
                        'active_to',
                        'permissionsSimple',
                        'avatar',
                    ],
                    'relationships' => [
                        'roles' => [
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