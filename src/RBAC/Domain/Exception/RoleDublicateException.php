<?php


namespace Scandinaver\RBAC\Domain\Exception;


use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class RoleDublicateException
 *
 * @package Scandinaver\RBAC\Domain\Exceptions
 */
class RoleDublicateException extends Exception
{

    protected $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;

    protected $message = 'Role already exists';
}