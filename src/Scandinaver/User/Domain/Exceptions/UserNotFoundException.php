<?php


namespace Scandinaver\User\Domain\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class UserNotFoundException
 *
 * @package Scandinaver\User\Domain\Exceptions
 */
class UserNotFoundException extends Exception
{
    protected $code = JsonResponse::HTTP_UNPROCESSABLE_ENTITY;

    protected $message = 'User not found';
}