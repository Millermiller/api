<?php


namespace Tests\Responses;


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
            'tooltipClass',
            'sort',
        ];
    }
}