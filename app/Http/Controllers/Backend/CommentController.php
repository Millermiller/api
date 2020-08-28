<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\Blog\Domain\Model\Comment;
use Scandinaver\Blog\UI\Command\CreateCommentCommand;
use Scandinaver\Blog\UI\Command\DeleteCommentCommand;
use Scandinaver\Blog\UI\Command\UpdateCommentCommand;
use Scandinaver\Blog\UI\Query\CommentQuery;
use Scandinaver\Blog\UI\Query\CommentsQuery;

/**
 * Class CommentController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class CommentController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CommentsQuery()));
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new CommentQuery($id)));
    }

    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreateCommentCommand($request->toArray()));

        return response()->json(NULL, 201);
    }

    public function update(Request $request, Comment $comment): JsonResponse
    {
        $this->commandBus->execute(new UpdateCommentCommand($comment, $request->toArray()));

        return response()->json(NULL, 201);
    }

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