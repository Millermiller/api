<?php

namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Class CommentController
 * @package App\Http\Controllers\Main\Backend
 */
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Comment::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Comment::findOrFail($id));
    }

    public function search()
    {
        $search = Input::get('q');

        return response()->json([
            'success' => true,
            'comments' => Comment::with(['author', 'post'])->where(function ($query) use ($search) {
                $query->where('text', 'LIKE', "%{$search}%");
            })->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(Comment::create($request->all()), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Comment::findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Comment::findOrFail($id);
        $category->update($request->all());

        return response()->json($category, 200);
    }
}