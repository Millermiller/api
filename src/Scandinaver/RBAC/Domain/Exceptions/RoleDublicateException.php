<?php


namespace Scandinaver\RBAC\Domain\Exceptions;


use Illuminate\Http\JsonResponse;

class RoleDublicateException extends \Exception
{
    protected $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;

    protected $message = 'Role already exists';
}