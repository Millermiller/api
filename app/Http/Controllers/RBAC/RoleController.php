<?php


namespace App\Http\Controllers\RBAC;


use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\RBAC\UI\Command\AttachPermissionToRoleCommand;
use Scandinaver\RBAC\UI\Command\CreateRoleCommand;
use Scandinaver\RBAC\UI\Command\DeleteRoleCommand;
use Scandinaver\RBAC\UI\Command\DetachPermissionFromRoleCommand;
use Scandinaver\RBAC\UI\Command\UpdateRoleCommand;
use Scandinaver\RBAC\UI\Query\RoleQuery;
use Scandinaver\RBAC\UI\Query\RolesQuery;

/**
 * Class RoleController
 *
 * @package App\Http\Controllers\RBAC
 */
class RoleController extends Controller
{
    public function index(): JsonResponse
    {
        Gate::authorize('view-roles');

        return $this->execute(new RolesQuery());
    }

    public function show(int $id): JsonResponse
    {
        Gate::authorize('show-role');

        return $this->execute(new RoleQuery($id));
    }

    public function destroy(int $id): JsonResponse
    {
        Gate::authorize('delete-role', $id);

        return $this->execute(new DeleteRoleCommand($id));
    }

    public function store(Request $request): JsonResponse
    {
        Gate::authorize('create-role');

        return $this->execute(new CreateRoleCommand($request->toArray()));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        Gate::authorize('update-role', $id);

        return $this->execute(new UpdateRoleCommand($id, $request->toArray()));
    }

    public function attachPermission(int $roleId, int $permissionId)
    {
        return $this->execute(new AttachPermissionToRoleCommand($roleId, $permissionId));
    }

    public function detachPermission(int $roleId, int $permissionId)
    {
        return $this->execute(new DetachPermissionFromRoleCommand($roleId,$permissionId));
    }

    public function search()
    {

    }
}