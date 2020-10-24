<?php


namespace Scandinaver\Learn\Domain\Exceptions;


use Exception;

class AssetNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Asset not found';
}