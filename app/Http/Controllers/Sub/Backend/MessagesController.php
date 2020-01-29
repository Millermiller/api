<?php


namespace App\Http\Controllers\Sub\Backend;

use ReflectionException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\Common\Application\Query\MessagesQuery;

/**
 * Class MessagesController
 * @package App\Http\Controllers\Sub\Backend
 */
class MessagesController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function all()
    {
        return response()->json($this->queryBus->execute(new MessagesQuery()));
    }


    public function destroy()
    {

    }

    public function read()
    {

    }
}