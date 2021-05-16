<?php


namespace Tests\Responses;

/**
 * Class Intro
 *
 * @package Tests\Responses
 */
class Intro implements ResponseInterface
{

    public static function response(): array
    {
        return [
            'id',
            'page',
            'target',
            'content',
            'position',
            'headerText',
            'sort',
        ];
    }
}