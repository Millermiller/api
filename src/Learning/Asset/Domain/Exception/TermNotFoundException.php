<?php


namespace Scandinaver\Learning\Asset\Domain\Exception;

use Exception;

/**
 * Class TermNotFoundException
 *
 * @package Scandinaver\Learn\Domain\Exceptions
 */
class TermNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Term not found';
}