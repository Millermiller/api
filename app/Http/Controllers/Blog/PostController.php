<?php


namespace App\Http\Controllers\Blog;

use App\Helpers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreatePostRequest;
use App\Http\Requests\Blog\UpdatePostRequest;
use App\Http\Requests\FilteringRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use JsonMapper_Exception;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Str;
use Scandinaver\Blog\Domain\Permission\Post;
use Scandinaver\Blog\UI\Command\CreatePostCommand;
use Scandinaver\Blog\UI\Command\DeletePostCommand;
use Scandinaver\Blog\UI\Command\UpdatePostCommand;
use Scandinaver\Blog\UI\Query\PostQuery;
use Scandinaver\Blog\UI\Query\PostsQuery;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostController
 *
 * @package App\Http\Controllers\Blog
 */
class PostController extends Controller
{

    /**
     * @param  FilteringRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws JsonMapper_Exception
     */
    public function index(FilteringRequest $request): JsonResponse
    {
        Gate::authorize(Post::VIEW);

        $params = $request->getRequestParameters();

        return $this->execute(new PostsQuery($params));
    }

    /**
     * @param  int  $postId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $postId): JsonResponse
    {
        Gate::authorize(Post::SHOW, $postId);

        return $this->execute(new PostQuery($postId));
    }

    /**
     * @param  CreatePostRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreatePostRequest $request): JsonResponse
    {
        Gate::authorize('create-post');

        return $this->execute(new CreatePostCommand(Auth::user(), $request->toArray()), Response::HTTP_CREATED);
    }

    /**
     * @param  UpdatePostRequest  $request
     * @param  int                $postId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdatePostRequest $request, int $postId): JsonResponse
    {
        Gate::authorize(Post::UPDATE, $postId);

        return $this->execute(new UpdatePostCommand(Auth::user(), $postId, $request->toArray()));
    }

    /**
     * @param  int  $postId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $postId): JsonResponse
    {
        Gate::authorize(Post::DELETE, $postId);

        return $this->execute(new DeletePostCommand($postId), Response::HTTP_NO_CONTENT);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     *
     *  TODO: implement
     */
    public function upload(Request $request): JsonResponse
    {
        Gate::authorize('upload-post');

        $file            = $request->file('img');
        $destinationPath = public_path() . '/uploads/articles/';
        $filename        = Str::random(20) . '.' . $file->getClientOriginalExtension() ?: 'png';

        $file->move($destinationPath, $filename);

        return response()->json(['data' => '/uploads/articles/' . $filename]);
    }
}