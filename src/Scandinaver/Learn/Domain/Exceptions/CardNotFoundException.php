<?php


namespace Scandinaver\Learn\Domain\Exceptions;


use Exception;

/**
 * Class CardNotFoundException
 *
 * @package Scandinaver\Learn\Domain\Exceptions
 */
class CardNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Card not found';
}