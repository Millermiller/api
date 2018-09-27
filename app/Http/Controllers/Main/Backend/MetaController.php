<?php

namespace App\Http\Controllers\Main\Backend;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;

/**
 * Class SeoController
 * @package App\Http\Controllers\Main\Backend
 */
class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(array_values(Meta::get()->sortByDesc('id')->toArray()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Meta::findOrFail($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json(Meta::create($request->all()), 201);
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
        $meta = Meta::findOrFail($id);
        $meta->update($request->all());

        return response()->json($meta, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meta = Meta::findOrFail($id);
        $meta->delete();

        return response()->json(null, 204);
    }
}