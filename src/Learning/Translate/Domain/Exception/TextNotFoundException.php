<?php


namespace Scandinaver\Learning\Translate\Domain\Exception;

use Exception;

/**
 * Class TextNotFoundException
 *
 * @package Scandinaver\Translate\Domain\Exception
 */
class TextNotFoundException extends Exception
{
    protected $code = '404';
    protected $message = 'Text not found';
}