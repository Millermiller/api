<?php


namespace App\Http\Controllers\Blog;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Blog\Domain\Permissions\Comment;
use Scandinaver\Blog\UI\Command\CreateCommentCommand;
use Scandinaver\Blog\UI\Command\DeleteCommentCommand;
use Scandinaver\Blog\UI\Command\UpdateCommentCommand;
use Scandinaver\Blog\UI\Query\{CommentQuery, CommentsQuery};
use Scandinaver\Shared\EventBusNotFoundException;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers\Blog
 */
class CommentController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Comment::VIEW);

        return $this->execute(new CommentsQuery());
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
        Gate::authorize(Comment::SHOW, $id);

        return $this->execute(new CommentQuery($id));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function store(Request $request): JsonResponse
    {
        Gate::authorize(Comment::CREATE);

        return $this->execute(new CreateCommentCommand(Auth::user(), $request->toArray()), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  Request  $request
     * @param  int      $commentId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function update(Request $request, int $commentId): JsonResponse
    {
        Gate::authorize(Comment::UPDATE, $commentId);

        return $this->execute(new UpdateCommentCommand($commentId, $request->toArray()));
    }

    /**
     * @param  int  $commentId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function destroy(int $commentId): JsonResponse
    {
        Gate::authorize(Comment::DELETE, $commentId);

        return $this->execute(new DeleteCommentCommand($commentId), JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @throws AuthorizationException
     */
    public function search()
    {
        Gate::authorize(Comment::SEARCH);
    }

}