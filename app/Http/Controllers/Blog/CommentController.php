<?php


namespace App\Http\Controllers\Blog;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreateCommentRequest;
use App\Http\Requests\Blog\UpdateCommentRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\Blog\Domain\Permission\Comment;
use Scandinaver\Blog\UI\Command\CreateCommentCommand;
use Scandinaver\Blog\UI\Command\DeleteCommentCommand;
use Scandinaver\Blog\UI\Command\UpdateCommentCommand;
use Scandinaver\Blog\UI\Query\{CommentQuery, CommentsQuery};
use Symfony\Component\HttpFoundation\Response;

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
     */
    public function show($id): JsonResponse
    {
        Gate::authorize(Comment::SHOW, $id);

        return $this->execute(new CommentQuery($id));
    }

    /**
     * @param  CreateCommentRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateCommentRequest $request): JsonResponse
    {
        Gate::authorize(Comment::CREATE);

        return $this->execute(new CreateCommentCommand(Auth::user(), $request->toArray()), Response::HTTP_CREATED);
    }

    /**
     * @param  UpdateCommentRequest  $request
     * @param  int                   $commentId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateCommentRequest $request, int $commentId): JsonResponse
    {
        Gate::authorize(Comment::UPDATE, $commentId);

        return $this->execute(new UpdateCommentCommand(Auth::user(), $commentId, $request->toArray()));
    }

    /**
     * @param  int  $commentId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $commentId): JsonResponse
    {
        Gate::authorize(Comment::DELETE, $commentId);

        return $this->execute(new DeleteCommentCommand($commentId), Response::HTTP_NO_CONTENT);
    }

    /**
     * @throws AuthorizationException
     */
    public function search()
    {
        Gate::authorize(Comment::SEARCH);
    }

}