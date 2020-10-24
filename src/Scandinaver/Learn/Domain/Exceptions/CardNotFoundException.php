<?php


namespace Scandinaver\Learn\Domain\Exceptions;


use Exception;

class CardNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Card not found';
}