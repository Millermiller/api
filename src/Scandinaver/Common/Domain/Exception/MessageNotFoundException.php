<?php


namespace Scandinaver\Common\Domain\Exception;


use Exception;

class MessageNotFoundException extends Exception
{
    protected $code = 404;

    protected $message = 'Message not found';
}