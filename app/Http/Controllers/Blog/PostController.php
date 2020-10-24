<?php


namespace App\Http\Controllers\Blog;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\{JsonResponse, Request};
use Scandinaver\Blog\UI\Command\CreatePostCommand;
use Scandinaver\Blog\UI\Command\DeletePostCommand;
use Scandinaver\Blog\UI\Command\UpdatePostCommand;
use Scandinaver\Blog\UI\Query\PostQuery;
use Scandinaver\Blog\UI\Query\PostsQuery;

/**
 * Class ArticleController
 *
 * @package App\Http\Controllers\Blog
 */
class PostController extends Controller
{
    public function index(): JsonResponse
    {
        Gate::authorize('view-posts');

        return $this->execute(new PostsQuery());
    }

    public function show(int $postId): JsonResponse
    {
        Gate::authorize('show-post', $postId);

        return $this->execute(new PostQuery($postId));
    }

    public function store(Request $request): JsonResponse
    {
        Gate::authorize('create-post');

        return $this->execute(new CreatePostCommand(Auth::user(), $request->toArray()), JsonResponse::HTTP_CREATED);
    }

    public function update(Request $request, int $postId): JsonResponse
    {
        Gate::authorize('update-post', $postId);

        return $this->execute(new UpdatePostCommand($postId, $request->toArray()));
    }

    public function destroy(int $postId): JsonResponse
    {
        Gate::authorize('delete-post', $postId);

        return $this->execute(new DeletePostCommand($postId), JsonResponse::HTTP_NO_CONTENT);
    }

    /** TODO: доделать
     *
     */
    public function upload(Request $request): JsonResponse
    {
        Gate::authorize('upload-post');

        $file = $request->file('img');
        $destinationPath = public_path().'/uploads/articles/';
        $filename = str_random(20).'.'.$file->getClientOriginalExtension() ?: 'png';

        $file->move($destinationPath, $filename);

        return response()->json(['data' => '/uploads/articles/'.$filename]);
    }
}