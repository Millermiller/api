<?php

namespace App\Http\Controllers\Main\Backend;

use App\Services\UserService;
use Scandinaver\User\Domain\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;
use \Illuminate\Http\Request;

/**
 * Class UsersController
 * @package App\Http\Controllers\Main\Backend
 *
 * Created by PhpStorm.
 * User: whiskey
 * Date: 29.11.14
 * Time: 18:47
 */
class UsersController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->userService->getAll());
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return response()->json($this->userService->getOne($user->getKey()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $user = $this->userService->updateUser($user, $request->toArray());

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $this->userService->delete($user);

        return response()->json(null, 204);
    }

    public function active()
    {
       // User::where('id', Input::get('id'))->update(['active_to' => Carbon::parse(Input::get('data'))]);

       // $this->answer['active'] = (Carbon::parse(Input::get('data')) > Carbon::today()) ? true : false;

       // return response()->json();
    }

    /**
     *
     */
    public function search()
    {
        return  $this->userService->find(Input::get('q'));
    }
}