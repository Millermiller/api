<?php


namespace Scandinaver\Learn\Domain\Exceptions;

use Exception;

/**
 * Class AssetNotFoundException
 *
 * @package Scandinaver\Learn\Domain\Exceptions
 */
class AssetNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Asset not found';
}