<?php


namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Application\Commands\DeleteMessageCommand;
use Scandinaver\Common\Application\Query\MessageQuery;
use Scandinaver\Common\Application\Query\MessagesQuery;
use Scandinaver\Common\Domain\Message;

/**
 * Class MessageController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class MessageController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new MessagesQuery()));
    }

    /** TODO: bind model
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new MessageQuery($id)));
    }

    /**
     * @param Message $message
     *
     * @return JsonResponse
     */
    public function destroy(Message $message): JsonResponse
    {
        $this->commandBus->execute(new DeleteMessageCommand($message));

        return response()->json(NULL, 204);
    }
}