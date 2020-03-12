<?php


namespace App\Http\Controllers\Main\Backend;

use ReflectionException;
use App\Http\Controllers\Controller;
use Scandinaver\Blog\Application\Commands\DeletePostCommand;
use Scandinaver\Blog\Domain\Post;
use Illuminate\Http\{JsonResponse, Request};
use Scandinaver\Blog\Application\Commands\{CreatePostCommand, UpdatePostCommand};
use Scandinaver\Blog\Application\Query\{PostQuery, PostsQuery};

/**
 * Class ArticleController
 * @package App\Http\Controllers\Main\Backend
 *
 * Created by PhpStorm.
 * User: user
 * Date: 11.05.2016
 * Time: 17:15
 */
class ArticleController extends Controller
{
    /**
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new PostsQuery()));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function show($id): JsonResponse
    {
        return response()->json($this->queryBus->execute(new PostQuery($id)));
    }

    /**
     * @param  Request $request
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function store(Request $request): JsonResponse
    {
        $this->commandBus->execute(new CreatePostCommand($request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $this->commandBus->execute(new UpdatePostCommand($post, $request->toArray()));

        return response()->json(null, 201);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     * @throws ReflectionException
     */
    public function destroy(Post $post): JsonResponse
    {
        $this->commandBus->execute(new DeletePostCommand($post));

        return response()->json(null, 204);
    }

    /** TODO: доделать
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $file = $request->file('img');
        $destinationPath = public_path() . '/uploads/articles/';
        $filename = str_random(20) . '.' . $file->getClientOriginalExtension() ?: 'png';

        $file->move($destinationPath, $filename);

        return response()->json(['data' => '/uploads/articles/'. $filename]);
    }
}