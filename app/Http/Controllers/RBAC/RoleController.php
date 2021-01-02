<?php


namespace App\Http\Controllers\RBAC;


use App\Http\Controllers\Controller;
use Exception;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
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

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        Gate::authorize('view-roles');

        return $this->execute(new RolesQuery());
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize('show-role', $id);

        return $this->execute(new RoleQuery($id));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize('delete-role', $id);

        return $this->execute(
          new DeleteRoleCommand($id),
          JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        Gate::authorize('create-role');

        return $this->execute(
          new CreateRoleCommand($request->toArray()),
          JsonResponse::HTTP_CREATED
        );
    }

    /**
     * @param  Request  $request
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function update(Request $request, int $id): JsonResponse
    {
        Gate::authorize('update-role', $id);

        return $this->execute(new UpdateRoleCommand($id, $request->toArray()));
    }

    /**
     * @param  int  $roleId
     * @param  int  $permissionId
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function attachPermission(int $roleId, int $permissionId): JsonResponse
    {
        return $this->execute(
          new AttachPermissionToRoleCommand($roleId, $permissionId)
        );
    }

    /**
     * @param  int  $roleId
     * @param  int  $permissionId
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function detachPermission(int $roleId, int $permissionId): JsonResponse
    {
        return $this->execute(
          new DetachPermissionFromRoleCommand($roleId, $permissionId)
        );
    }

    public function search()
    {

    }

}