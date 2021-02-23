<?php


namespace Scandinaver\RBAC\Domain\Exceptions;


use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class PermissionDublicateException
 *
 * @package Scandinaver\RBAC\Domain\Exceptions
 */
class PermissionDublicateException extends Exception
{
    protected $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;

    protected $message = 'Permission already exists';
}