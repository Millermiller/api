<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\User\Application\Commands\DeleteUserCommand;
use Scandinaver\User\Application\Commands\UpdateUserCommand;
use Scandinaver\User\Application\Query\UserQuery;
use Scandinaver\User\Application\Query\UsersQuery;
use Scandinaver\User\Domain\User;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class UsersController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new UsersQuery()));
    }

    /**
     * @param User $user
     *
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json($this->queryBus->execute(new UserQuery($user->getKey())));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return JsonResponse
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $this->commandBus->execute(new UpdateUserCommand($user, $request->toArray()));

        return response()->json(NULL, 201);
    }

    /**
     * @param User $user
     *
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $this->commandBus->execute(new DeleteUserCommand($user));

        return response()->json(NULL, 204);
    }

    public function active()
    {
        // User::where('id', Input::get('id'))->update(['active_to' => Carbon::parse(Input::get('data'))]);

        // $this->answer['active'] = (Carbon::parse(Input::get('data')) > Carbon::today()) ? true : false;

        // return response()->json();
    }

    public function search()
    {
        // return $this->userService->find(Input::get('q'));
    }
}