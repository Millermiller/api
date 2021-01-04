<?php


namespace Scandinaver\Shared;


use Exception;
use Illuminate\Http\JsonResponse;

class EventBusNotFoundException extends Exception
{
    protected $message = 'Bus not Found';

    protected $code = JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
}