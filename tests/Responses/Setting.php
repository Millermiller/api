<?php


namespace Tests\Responses;

/**
 * Class Setting
 *
 * @package Tests\Responses
 */
class Setting implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'title',
            'slug',
            'type',
            'value',
        ];
    }
}