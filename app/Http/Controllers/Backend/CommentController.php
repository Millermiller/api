<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Blog\Application\Commands\CreateCommentCommand;
use Scandinaver\Blog\Application\Commands\DeleteCommentCommand;
use Scandinaver\Blog\Application\Commands\UpdateCommentCommand;
use Scandinaver\Blog\Application\Query\CommentQuery;
use Scandinaver\Blog\Application\Query\CommentsQuery;
use Scandinaver\Blog\Domain\Comment;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class CommentController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CommentsQuery()));
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CommentQuery($id)));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreateCommentCommand($request->toArray()));

        return response()->json(NULL, 201);
    }

    /**
     * @param Request $request
     * @param Comment $comment
     *
     * @return JsonResponse
     */
    public function update(Request $request, Comment $comment): JsonResponse
    {
        $this->commandBus->execute(new UpdateCommentCommand($comment, $request->toArray()));

        return response()->json(NULL, 201);
    }

    /**
     * @param Comment $comment
     *
     * @return JsonResponse
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $this->commandBus->execute(new DeleteCommentCommand($comment));

        return response()->json(NULL, 204);
    }

    public function search()
    {
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