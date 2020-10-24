<?php


namespace Scandinaver\Learn\Domain\Exceptions;


use Exception;

class WordNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Word not found';
}