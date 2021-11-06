<?php


namespace Scandinaver\Learning\Asset\Domain\Exception;

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