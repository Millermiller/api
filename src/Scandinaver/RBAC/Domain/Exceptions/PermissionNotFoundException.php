<?php


namespace Scandinaver\RBAC\Domain\Exceptions;


use Exception;

/**
 * Class PermissionNotFoundException
 *
 * @package Scandinaver\RBAC\Domain\Exceptions
 */
class PermissionNotFoundException extends Exception
{
    protected $code = '404';

    protected $message = 'Permission not found';
}