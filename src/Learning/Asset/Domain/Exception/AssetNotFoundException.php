<?php


namespace Scandinaver\Learning\Asset\Domain\Exception;

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