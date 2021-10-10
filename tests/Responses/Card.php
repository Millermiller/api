<?php


namespace Tests\Responses;

/**
 * Class Card
 *
 * @package Tests\Responses
 */
class Card implements ResponseInterface
{

    public static function response(): array
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
}