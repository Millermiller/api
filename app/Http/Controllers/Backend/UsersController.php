<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\UI\Command\DeleteUserCommand;
use Scandinaver\User\UI\Command\UpdateUserCommand;
use Scandinaver\User\UI\Query\UserQuery;
use Scandinaver\User\UI\Query\UsersQuery;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\Main\Backend
 */
class UsersController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json($this->queryBus->execute(new UsersQuery()));
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($this->queryBus->execute(new UserQuery($user->getKey())));
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $this->commandBus->execute(new UpdateUserCommand($user, $request->toArray()));

        return response()->json(NULL, 201);
    }

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