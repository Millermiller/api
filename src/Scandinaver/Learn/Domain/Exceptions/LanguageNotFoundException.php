<?php


namespace Scandinaver\Learn\Domain\Exceptions;


use Exception;

/**
 * Class LanguageNotFoundException
 *
 * @package Scandinaver\Learn\Domain\Exceptions
 */
class LanguageNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Language not found';
}