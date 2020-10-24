<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\UI\Command\DeleteUserCommand;
use Scandinaver\User\UI\Command\UpdateUserCommand;
use Scandinaver\User\UI\Query\UserQuery;
use Scandinaver\User\UI\Query\UsersQuery;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{
    public function index(): JsonResponse
    {
        Gate::authorize('view-users');

        return $this->execute(new UsersQuery());
    }

    public function show(int $userId): JsonResponse
    {
        Gate::authorize('view-user', $userId);

        return $this->execute(new UserQuery($userId));
    }

    public function store(Request $request)
    {
        Gate::authorize('create-user');
    }

    public function update(Request $request, int $userId): JsonResponse
    {
        Gate::authorize('update-user', $userId);

        return $this->execute(new UpdateUserCommand($userId, $request->toArray()));
    }

    public function destroy(int $userId): JsonResponse
    {
        Gate::authorize('delete-user', $userId);

        return $this->execute(new DeleteUserCommand($userId), JsonResponse::HTTP_NO_CONTENT);
    }

    public function active(int $userId)
    {
        Gate::authorize('update-user', $userId);

        // User::where('id', Input::get('id'))->update(['active_to' => Carbon::parse(Input::get('data'))]);

        // $this->answer['active'] = (Carbon::parse(Input::get('data')) > Carbon::today()) ? true : false;

        // return response()->json();
    }

    public function search()
    {
        Gate::authorize('view-users');
        // return $this->userService->find(Input::get('q'));
    }
}