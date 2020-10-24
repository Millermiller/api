<?php


namespace Scandinaver\Translate\Domain\Exception;


use Exception;

class TextNotFoundException extends Exception
{
    protected $code = '404';
    protected $message = 'Text not found';
}