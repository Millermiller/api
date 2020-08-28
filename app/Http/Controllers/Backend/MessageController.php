<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Model\Message;
use Scandinaver\Common\UI\Command\DeleteMessageCommand;
use Scandinaver\Common\UI\Query\MessageQuery;
use Scandinaver\Common\UI\Query\MessagesQuery;

/**
 * Class MessageController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class MessageController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new MessagesQuery()));
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new MessageQuery($id)));
    }

    public function destroy(Message $message): JsonResponse
    {
        $this->commandBus->execute(new DeleteMessageCommand($message));

        return response()->json(NULL, 204);
    }
}