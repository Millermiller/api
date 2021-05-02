<?php


namespace Scandinaver\Learn\Domain\Exception;

use Exception;

/**
 * Class WordNotFoundException
 *
 * @package Scandinaver\Learn\Domain\Exceptions
 */
class WordNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Word not found';
}