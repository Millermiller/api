<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Exception;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\User\UI\Command\CreateUserCommand;
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

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        Gate::authorize('view-users');

        return $this->execute(new UsersQuery());
    }

    /**
     * @param  int  $userId
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function show(int $userId): JsonResponse
    {
        Gate::authorize('show-user', $userId);

        return $this->execute(new UserQuery($userId));
    }

    /**
     * @param  ProfileRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function store(ProfileRequest $request): JsonResponse
    {
        Gate::authorize('create-user');

        $data = $request->toArray();

        return $this->execute(new CreateUserCommand($data));
    }

    /**
     * @param  Request  $request
     * @param  int      $userId
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request, int $userId): JsonResponse
    {
        Gate::authorize('update-user', $userId);

        return $this->execute(new UpdateUserCommand($userId, $request->toArray()));
    }

    /**
     * @param  int  $userId
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $userId): JsonResponse
    {
        Gate::authorize('delete-user', $userId);

        return $this->execute(new DeleteUserCommand($userId), JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @param  int  $userId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function active(int $userId)
    {
        Gate::authorize('update-user', $userId);

        // User::where('id', Input::get('id'))->update(['active_to' => Carbon::parse(Input::get('data'))]);

        // $this->answer['active'] = (Carbon::parse(Input::get('data')) > Carbon::today()) ? true : false;

        // return response()->json();
    }

    /**
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function search()
    {
        Gate::authorize('view-users');
        // return $this->userService->find(Input::get('q'));
    }
}