<?php


namespace Scandinaver\Learn\Domain\Exceptions;

use Exception;

/**
 * Class PassingNotFoundException
 *
 * @package Scandinaver\Learn\Domain\Exceptions
 */
class PassingNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Passing not found';
}