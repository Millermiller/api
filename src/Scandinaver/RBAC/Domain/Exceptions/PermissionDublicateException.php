<?php


namespace Scandinaver\RBAC\Domain\Exceptions;


use Illuminate\Http\JsonResponse;

class PermissionDublicateException extends \Exception
{
    protected $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;

    protected $message = 'Permission already exists';
}