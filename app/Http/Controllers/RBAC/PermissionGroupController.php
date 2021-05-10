<?php


namespace App\Http\Controllers\RBAC;

use App\Http\Controllers\Controller;
use App\Http\Requests\RBAC\CreatePermissionGroupRequest;
use App\Http\Requests\RBAC\UpdatePermissionGroupRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse};
use Scandinaver\RBAC\Domain\Permission\PermissionGroup;
use Scandinaver\RBAC\UI\Command\CreatePermissionGroupCommand;
use Scandinaver\RBAC\UI\Command\DeletePermissionGroupCommand;
use Scandinaver\RBAC\UI\Command\UpdatePermissionGroupCommand;
use Scandinaver\RBAC\UI\Query\PermissionGroupQuery;
use Scandinaver\RBAC\UI\Query\PermissionGroupsQuery;

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
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize(PermissionGroup::SHOW, $id);

        return $this->execute(new PermissionGroupQuery($id));
    }

    /**
     * @param  CreatePermissionGroupRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreatePermissionGroupRequest $request): JsonResponse
    {
        Gate::authorize(PermissionGroup::CREATE);

        return $this->execute(new CreatePermissionGroupCommand($request->toArray()), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  UpdatePermissionGroupRequest  $request
     * @param  int                           $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdatePermissionGroupRequest $request, int $id): JsonResponse
    {
        Gate::authorize(PermissionGroup::UPDATE, $id);

        return $this->execute(new UpdatePermissionGroupCommand($id, $request->toArray()));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(PermissionGroup::DELETE, $id);

        return $this->execute(new DeletePermissionGroupCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }

    public function search()
    {
    }

}