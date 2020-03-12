<?php


namespace App\Http\Controllers\Main\Backend;

use ReflectionException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Scandinaver\Blog\Application\Commands\CreateCommentCommand;
use Scandinaver\Blog\Application\Commands\DeleteCommentCommand;
use Scandinaver\Blog\Application\Commands\UpdateCommentCommand;
use Scandinaver\Blog\Application\Query\CommentQuery;
use Scandinaver\Blog\Application\Query\CommentsQuery;
use Scandinaver\Blog\Domain\Comment;

/**
 * Class CommentController
 * @package App\Http\Controllers\Main\Backend
 */
class CommentController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CommentsQuery()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CommentQuery($id)));
    }

    /**
     * @param  Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreateCommentCommand($request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @param Request $request
     * @param Comment $comment
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function update(Request $request, Comment $comment): JsonResponse
    {
        $this->commandBus->execute(new UpdateCommentCommand($comment, $request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @param Comment $comment
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $this->commandBus->execute(new DeleteCommentCommand($comment));

        return response()->json(null, 204);
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