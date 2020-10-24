<?php


namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\UI\Command\DeleteMessageCommand;
use Scandinaver\Common\UI\Query\MessageQuery;
use Scandinaver\Common\UI\Query\MessagesQuery;

/**
 * Class MessageController
 *
 * @package App\Http\Controllers\Common
 */
class MessageController extends Controller
{
    public function index(): JsonResponse
    {
        Gate::authorize('view-messages');

        return $this->execute(new MessagesQuery());
    }

    public function show($id): JsonResponse
    {
        Gate::authorize('show-message', $id);

        return $this->execute(new MessageQuery($id));
    }

    public function destroy(int $messageId): JsonResponse
    {
        Gate::authorize('delete-message', $messageId);

        $this->execute(new DeleteMessageCommand($messageId), JsonResponse::HTTP_NO_CONTENT);

        return response()->json(NULL, 204);
    }

    public function read()
    {
        
    }
}