<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilteringRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use JsonMapper_Exception;
use Illuminate\Http\{JsonResponse, Request};
use Scandinaver\User\Domain\Permission\User;
use Scandinaver\User\UI\Command\CreateUserCommand;
use Scandinaver\User\UI\Command\DeleteUserCommand;
use Scandinaver\User\UI\Command\UpdateUserCommand;
use Symfony\Component\HttpFoundation\Response;
use Scandinaver\User\UI\Query\{UserQuery, UsersQuery};

/**
 * Class UserController
 *
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{

    /**
     * @param  FilteringRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws JsonMapper_Exception
     */
    public function index(FilteringRequest $request): JsonResponse
    {
        Gate::authorize(User::VIEW);

        $includes = $request->get('includes', []);
        $params = $request->getRequestParameters();

        return $this->execute(new UsersQuery($includes, $params));
    }

    /**
     * @param  Request  $request
     * @param  int      $userId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Request $request, int $userId): JsonResponse
    {
        Gate::authorize(User::SHOW, $userId);

        $includes = $request->get('includes', []);

        return $this->execute(new UserQuery($userId, $includes));
    }

    /**
     * @param  CreateUserRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        Gate::authorize(User::CREATE);

        $data = $request->toArray();

        return $this->execute(new CreateUserCommand($data));
    }

    /**
     * @param  UpdateUserRequest  $request
     * @param  int                $userId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, int $userId): JsonResponse
    {
        Gate::authorize(User::UPDATE, $userId);

        return $this->execute(new UpdateUserCommand($userId, $request->toArray()));
    }

    /**
     * @param  int  $userId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $userId): JsonResponse
    {
        Gate::authorize(User::DELETE, $userId);

        return $this->execute(new DeleteUserCommand($userId), Response::HTTP_NO_CONTENT);
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