<?php


namespace Scandinaver\RBAC\Domain\Exceptions;


use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class PermissionGroupDublicateException
 *
 * @package Scandinaver\RBAC\Domain\Exceptions
 */
class PermissionGroupDublicateException extends Exception
{
    protected $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;

    protected $message = 'Permission group already exists';
}