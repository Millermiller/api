<?php


namespace Scandinaver\Learn\Domain\Exceptions;


use Exception;

class LanguageNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Language not found';
}