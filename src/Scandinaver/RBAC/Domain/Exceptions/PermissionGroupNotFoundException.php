<?php


namespace Scandinaver\RBAC\Domain\Exceptions;


class PermissionGroupNotFoundException extends \Exception
{
    protected $code = '404';

    protected $message = 'Permission group not found';
}