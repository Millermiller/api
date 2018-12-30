<?php

namespace App\Http\Controllers\Sub\Backend;

use App\Http\Controllers\Controller;
use App\Models\Intro;
use \Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: john
 * Date: 30.08.2017
 * Time: 20:36
 *
 * Class IntroController
 * @package Application\Controllers\Admin
 */
class IntroController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Intro::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Intro::findOrFail($id));
    }

    public function store()
    {
        $intro =  new Intro();

        return response()->json(['success' => true, 'intro' => $intro]);
    }

    public function update(Request $request, $id)
    {
        $intro = Intro::findOrFail($id);
        $intro->update($request->all());

        return response()->json($intro, 200);
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
        $puzzle = Intro::findOrFail($id);
        $puzzle->delete();

        return response()->json(null, 204);
    }
}