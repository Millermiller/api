<?php

/**
 * Class UsersController
 * @package Application\Controllers\Admin
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 29.11.14
 * Time: 18:47
 */

namespace App\Http\Controllers\Main\Backend;

use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use \Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::with('plan')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //
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
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }

    public function active()
    {
       // User::where('id', Input::get('id'))->update(['active_to' => Carbon::parse(Input::get('data'))]);

       // $this->answer['active'] = (Carbon::parse(Input::get('data')) > Carbon::today()) ? true : false;

       // return response()->json();
    }

    public function search()
    {
        $search = Input::get('q');

        return User::where(function ($query) use ($search) {
            $query->where('login', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        })->get();
    }
}