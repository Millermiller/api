<?php

namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Class ArticleController
 * @package Application\Controllers\Admin
 *
 * Created by PhpStorm.
 * User: user
 * Date: 11.05.2016
 * Time: 17:15
 */
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(array_values(Post::with(['category', 'comments'])->get()->sortByDesc('id')->toArray()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Post::with(['category'])->find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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