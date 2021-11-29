<?php


namespace Scandinaver\Core\Domain\Exception;


use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Class EventBusNotFoundException
 *
 * @package Scandinaver\Core\Domain\Exception
 */
class EventBusNotFoundException extends Exception
{
    protected $message = 'Bus not Found';

    protected $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
}