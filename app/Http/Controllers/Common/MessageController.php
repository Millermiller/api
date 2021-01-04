<?php


namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\JsonResponse;
use Scandinaver\Shared\EventBusNotFoundException;
use Scandinaver\Common\Domain\Permissions\Message;
use Illuminate\Auth\Access\AuthorizationException;
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

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Message::VIEW);

        return $this->execute(new MessagesQuery());
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function show($id): JsonResponse
    {
        Gate::authorize(Message::SHOW, $id);

        return $this->execute(new MessageQuery($id));
    }

    /**
     * @param  int  $messageId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function destroy(int $messageId): JsonResponse
    {
        Gate::authorize(Message::DELETE, $messageId);

        $this->execute(new DeleteMessageCommand($messageId), JsonResponse::HTTP_NO_CONTENT);

        return response()->json(NULL, 204);
    }

    public function read()
    {
        
    }
}