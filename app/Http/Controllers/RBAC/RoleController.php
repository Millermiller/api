<?php


namespace App\Http\Controllers\RBAC;

use App\Http\Controllers\Controller;
use App\Http\Requests\RBAC\CreateRoleRequest;
use App\Http\Requests\RBAC\UpdateRoleRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\{JsonResponse};
use Scandinaver\RBAC\Domain\Permission\Role;
use Scandinaver\RBAC\UI\Command\AttachPermissionToRoleCommand;
use Scandinaver\RBAC\UI\Command\CreateRoleCommand;
use Scandinaver\RBAC\UI\Command\DeleteRoleCommand;
use Scandinaver\RBAC\UI\Command\DetachPermissionFromRoleCommand;
use Scandinaver\RBAC\UI\Command\UpdateRoleCommand;
use Scandinaver\RBAC\UI\Query\{RoleQuery, RolesQuery};

/**
 * Class RoleController
 *
 * @package App\Http\Controllers\RBAC
 */
class RoleController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Role::VIEW);

        return $this->execute(new RolesQuery());
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize(Role::SHOW, $id);

        return $this->execute(new RoleQuery($id));
    }

    /**
     * @param  CreateRoleRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreateRoleRequest $request): JsonResponse
    {
        Gate::authorize(Role::CREATE);

        return $this->execute(new CreateRoleCommand($request->toArray()), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  UpdateRoleRequest  $request
     * @param  int                $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdateRoleRequest $request, int $id): JsonResponse
    {
        Gate::authorize(Role::UPDATE, $id);

        return $this->execute(new UpdateRoleCommand($id, $request->toArray()));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(Role::DELETE, $id);

        return $this->execute(new DeleteRoleCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @param  int  $id
     * @param  int  $permissionId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function attachPermission(int $id, int $permissionId): JsonResponse
    {
        Gate::authorize(Role::UPDATE, $id);

        return $this->execute(new AttachPermissionToRoleCommand($id, $permissionId));
    }

    /**
     * @param  int  $id
     * @param  int  $permissionId
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function detachPermission(int $id, int $permissionId): JsonResponse
    {
        Gate::authorize(Role::UPDATE, $id);

        return $this->execute(new DetachPermissionFromRoleCommand($id, $permissionId));
    }

    public function search()
    {
    }

}