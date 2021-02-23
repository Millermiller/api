<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse, Request};
use Scandinaver\Shared\EventBusNotFoundException;
use Scandinaver\User\Domain\Permissions\User;
use Scandinaver\User\UI\Command\CreateUserCommand;
use Scandinaver\User\UI\Command\DeleteUserCommand;
use Scandinaver\User\UI\Command\UpdateUserCommand;
use Scandinaver\User\UI\Query\{UserQuery, UsersQuery};

/**
 * Class UserController
 *
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(User::VIEW);

        return $this->execute(new UsersQuery());
    }

    /**
     * @param  int  $userId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function show(int $userId): JsonResponse
    {
        Gate::authorize(User::SHOW, $userId);

        return $this->execute(new UserQuery($userId));
    }

    /**
     * @param  ProfileRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function store(ProfileRequest $request): JsonResponse
    {
        Gate::authorize(User::CREATE);

        $data = $request->toArray();

        return $this->execute(new CreateUserCommand($data));
    }

    /**
     * @param  Request  $request
     * @param  int      $userId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function update(Request $request, int $userId): JsonResponse
    {
        Gate::authorize(User::UPDATE, $userId);

        return $this->execute(new UpdateUserCommand($userId, $request->toArray()));
    }

    /**
     * @param  int  $userId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function destroy(int $userId): JsonResponse
    {
        Gate::authorize(User::DELETE, $userId);

        return $this->execute(new DeleteUserCommand($userId), JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @param  int  $userId
     *
     * @throws AuthorizationException
     */
    public function active(int $userId)
    {
        Gate::authorize(User::UPDATE, $userId);

        // User::where('id', Input::get('id'))->update(['active_to' => Carbon::parse(Input::get('data'))]);

        // $this->answer['active'] = (Carbon::parse(Input::get('data')) > Carbon::today()) ? true : false;

        // return response()->json();
    }

    /**
     * @throws AuthorizationException
     */
    public function search()
    {
        Gate::authorize('view-users');
        // return $this->userService->find(Input::get('q'));
    }

}