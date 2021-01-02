<?php


namespace App\Http\Controllers\Blog;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Exception;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Blog\UI\Command\CreateCommentCommand;
use Scandinaver\Blog\UI\Command\DeleteCommentCommand;
use Scandinaver\Blog\UI\Command\UpdateCommentCommand;
use Scandinaver\Blog\UI\Query\CommentQuery;
use Scandinaver\Blog\UI\Query\CommentsQuery;

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
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        Gate::authorize('view-comments');

        return $this->execute(new CommentsQuery());
    }

    public function show($id): JsonResponse
    {
        Gate::authorize('show-comment', $id);

        return $this->execute(new CommentQuery($id));
    }

    public function store(Request $request): JsonResponse
    {
        Gate::authorize('create-comment');

        return $this->execute(new CreateCommentCommand(Auth::user(), $request->toArray()), JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, int $commentId): JsonResponse
    {
        Gate::authorize('update-comment', $commentId);

        return $this->execute(new UpdateCommentCommand($commentId, $request->toArray()));
    }

    public function destroy(int $commentId): JsonResponse
    {
        Gate::authorize('delete-comment', $commentId);

        return $this->execute(new DeleteCommentCommand($commentId), JsonResponse::HTTP_NO_CONTENT);
    }

    public function search()
    {
        Gate::authorize('search-comment');

        /*
        $search = Input::get('q');

        return response()->json([
            'success' => true,
            'comments' => Comment::with(['author', 'post'])->where(function ($query) use ($search) {
                $query->where('text', 'LIKE', "%{$search}%");
            })->get()
        ]);
        */
    }

}