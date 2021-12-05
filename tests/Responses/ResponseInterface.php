<?php


namespace Tests\Responses;

/**
 * Interface ResponseInterface
 *
 * @package Tests\Responses
 */
interface ResponseInterface
{

    public static function singleResponse(): array;

    public static function collectionResponse(): array;
}