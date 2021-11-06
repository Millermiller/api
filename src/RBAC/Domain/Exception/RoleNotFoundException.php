<?php


namespace Scandinaver\RBAC\Domain\Exception;


use Exception;

/**
 * Class RoleNotFoundException
 *
 * @package Scandinaver\RBAC\Domain\Exceptions
 */
class RoleNotFoundException extends Exception
{

    protected $code = '404';

    protected $message = 'Role not found';
}