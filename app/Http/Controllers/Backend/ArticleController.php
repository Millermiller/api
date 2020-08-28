<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Blog\UI\Command\CreatePostCommand;
use Scandinaver\Blog\UI\Command\DeletePostCommand;
use Scandinaver\Blog\UI\Command\UpdatePostCommand;
use Scandinaver\Blog\UI\Query\PostQuery;
use Scandinaver\Blog\UI\Query\PostsQuery;

/**
 * Class ArticleController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class ArticleController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new PostsQuery()));
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new PostQuery($id)));
    }

    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreatePostCommand($request->toArray()));

        return response()->json(NULL, 201);
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        $this->commandBus->execute(new UpdatePostCommand($post, $request->toArray()));

        return response()->json(NULL, 201);
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->commandBus->execute(new DeletePostCommand($post));

        return response()->json(NULL, 204);
    }

    /** TODO: доделать
     *
     */
    public function upload(Request $request): JsonResponse
    {
        $file            = $request->file('img');
        $destinationPath = public_path() . '/uploads/articles/';
        $filename        = str_random(20) . '.' . $file->getClientOriginalExtension() ?: 'png';

        $file->move($destinationPath, $filename);

        return response()->json(['data' => '/uploads/articles/' . $filename]);
    }
}