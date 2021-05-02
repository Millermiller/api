<?php


namespace Scandinaver\User\Domain\Exception;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class UserNotFoundException
 *
 * @package Scandinaver\User\Domain\Exceptions
 */
class UserNotFoundException extends Exception
{
    protected $code = JsonResponse::HTTP_NOT_FOUND;

    protected $message = 'User not found';
}