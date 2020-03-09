<?php

namespace App\Http\Controllers\Main\Backend;

use ReflectionException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\Common\Domain\Message;
use Scandinaver\Common\Application\Commands\DeleteMessageCommand;
use Scandinaver\Common\Application\Query\MessageQuery;
use Scandinaver\Common\Application\Query\MessagesQuery;

/**
 * Class SeoController
 * @package App\Http\Controllers\Main\Backend
 */
class MessageController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function index()
    {
        return response()->json($this->queryBus->execute(new MessagesQuery()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function show($id)
    {
        return response()->json($this->queryBus->execute(new MessageQuery($id)));
    }

    /**
     * @param Message $message
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function destroy(Message $message)
    {
        $this->commandBus->execute(new DeleteMessageCommand($message));

        return response()->json(null, 204);
    }
}