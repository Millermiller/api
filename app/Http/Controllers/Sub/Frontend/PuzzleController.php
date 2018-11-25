<?php
/**
 * Created by PhpStorm.
 * User: john_
 * Date: 22.11.2018
 * Time: 4:35
 */

namespace App\Http\Controllers\Sub\Frontend;

use App\Models\Puzzle;
use \Illuminate\Http\Request;

class PuzzleController
{
    public function index()
    {
        return response()->json(Puzzle::all());
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
        $puzzle = Puzzle::find($id);

        if($puzzle->users()->where('users.id', \Auth::id())->count() == 0)
            $puzzle->users()->attach(\Auth::id());

        return response()->json($puzzle, 200);
    }
}