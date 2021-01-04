<?php


namespace App\Http\Controllers\RBAC;


use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use Scandinaver\Shared\EventBusNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Scandinaver\RBAC\UI\Query\PermissionGroupQuery;
use Scandinaver\RBAC\UI\Query\PermissionGroupsQuery;
use Scandinaver\RBAC\Domain\Permissions\PermissionGroup;
use Scandinaver\RBAC\UI\Command\CreatePermissionGroupCommand;
use Scandinaver\RBAC\UI\Command\DeletePermissionGroupCommand;
use Scandinaver\RBAC\UI\Command\UpdatePermissionGroupCommand;

/**
 * Class RoleController
 *
 * @package App\Http\Controllers\RBAC
 */
class PermissionGroupController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(PermissionGroup::VIEW);

        return $this->execute(new PermissionGroupsQuery());
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize(PermissionGroup::SHOW, $id);

        return $this->execute(new PermissionGroupQuery($id));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(PermissionGroup::DELETE, $id);

        return $this->execute(
          new DeletePermissionGroupCommand($id),
          JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function store(Request $request): JsonResponse
    {
        Gate::authorize(PermissionGroup::CREATE);

        return $this->execute(
          new CreatePermissionGroupCommand($request->toArray()),
          JsonResponse::HTTP_CREATED
        );
    }

    /**
     * @param  Request  $request
     * @param  int      $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws EventBusNotFoundException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        Gate::authorize(PermissionGroup::UPDATE, $id);

        return $this->execute(
          new UpdatePermissionGroupCommand($id, $request->toArray())
        );
    }


    public function search()
    {
    }

}