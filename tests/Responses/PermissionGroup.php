<?php


namespace Tests\Responses;

use JetBrains\PhpStorm\ArrayShape;

/**
 * Class PermissionGroup
 *
 * @package Tests\Responses
 */
class PermissionGroup implements ResponseInterface
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
                'attributes' =>
                    [
                        "name",
                        "slug",
                        "description",
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
                    'attributes' =>
                        [
                            "name",
                            "slug",
                            "description",
                        ],
                ],
            ],
        ];
    }
}