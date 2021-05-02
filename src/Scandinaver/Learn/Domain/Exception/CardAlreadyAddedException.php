<?php


namespace Scandinaver\Learn\Domain\Exception;

use Exception;

/**
 * Class CardAlreadyAddedException
 *
 * @package Scandinaver\Learn\Domain\Exceptions
 */
class CardAlreadyAddedException extends Exception
{
    protected $code = 400;
}