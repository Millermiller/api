<?php


namespace Scandinaver\RBAC\Domain\Exceptions;


use Illuminate\Http\JsonResponse;

class PermissionGroupDublicateException extends \Exception
{
    protected $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;

    protected $message = 'Permission group already exists';
}