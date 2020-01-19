<?php

namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use App\Entities\Post;
use App\Services\PostService;
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Support\Facades\Input;

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
     * @var PostService
     */
    private $postService;

    /**
     * ArticleController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->postService->getAll());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return response()->json(Post::with(['category'])->find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return response()->json(Post::create($request->all()), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(null, 204);
    }

    public function search()
    {
        $search = Input::get('q');

        return response()->json([
            'success' => true,
            'articles' => Post::with(['category', 'comments'])->where(function ($query) use ($search) {
                /** @var \Illuminate\Database\Eloquent\Builder $query*/
                $query->where('post_name', 'LIKE', "%{$search}%");
            })->get()
        ]);
    }

    public function upload(Request $request)
    {
        $file = $request->file('img');
        $destinationPath = public_path() . '/uploads/articles/';
        $filename = str_random(20) . '.' . $file->getClientOriginalExtension() ?: 'png';

        $file->move($destinationPath, $filename);

        return response()->json(['data' => '/uploads/articles/'. $filename]);

    }
}