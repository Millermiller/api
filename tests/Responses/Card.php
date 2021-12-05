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

    #[ArrayShape([0 => "string", 1 => "string", 'term' => "string[]", 'translate' => "string[]", 4 => "string"])]
    public static function singleResponse(): array
    {
        return [
            'id',
            'favourite',
            'term'      => [
                'id',
                'value',
            ],
            'translate' => [
                'id',
                'value',
            ],
            'examples'
        ];
    }

    public static function collectionResponse(): array
    {
        // TODO: Implement collectionResponse() method.
    }
}