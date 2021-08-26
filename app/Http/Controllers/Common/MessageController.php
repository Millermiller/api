<?php


namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Common\Domain\Permission\Message;
use Scandinaver\Common\UI\Command\DeleteMessageCommand;
use Scandinaver\Common\UI\Query\MessageQuery;
use Scandinaver\Common\UI\Query\MessagesQuery;
use Symfony\Component\HttpFoundation\Response;

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
     */
    public function destroy(int $messageId): JsonResponse
    {
        Gate::authorize(Message::DELETE, $messageId);

        $this->execute(new DeleteMessageCommand($messageId), Response::HTTP_NO_CONTENT);

        return response()->json(NULL, 204);
    }

    public function read()
    {

    }
}