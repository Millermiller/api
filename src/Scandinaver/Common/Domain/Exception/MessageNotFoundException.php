<?php


namespace Scandinaver\Common\Domain\Exception;

use Exception;

/**
 * Class MessageNotFoundException
 *
 * @package Scandinaver\Common\Domain\Exception
 */
class MessageNotFoundException extends Exception
{
    protected $code = 404;

    protected $message = 'Message not found';
}