<?php


namespace Scandinaver\User\Domain\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserNotFoundException
 *
 * @package Scandinaver\User\Domain\Exceptions
 */
class UserNotFoundException extends Exception
{

    protected $code = Response::HTTP_NOT_FOUND;

    protected $message = 'User not found';
}