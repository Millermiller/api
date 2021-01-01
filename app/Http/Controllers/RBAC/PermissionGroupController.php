<?php


namespace App\Http\Controllers\RBAC;


use App\Http\Controllers\Controller;
use Exception;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        Gate::authorize('view-permission-groups');

        return $this->execute(new PermissionGroupsQuery());
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
        Gate::authorize('show-permission-group');

        return $this->execute(new PermissionGroupQuery($id));
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
        Gate::authorize('delete-permission-group', $id);

        return $this->execute(new DeletePermissionGroupCommand($id));
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
        Gate::authorize('create-permission-group');

        return $this->execute(new CreatePermissionGroupCommand($request->toArray()));
    }

    /**
     * @param  Request  $request
     * @param  int      $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function update(Request $request, int $id): JsonResponse
    {
        Gate::authorize('update-permission-group', $id);

        return $this->execute(new UpdatePermissionGroupCommand($id, $request->toArray()));
    }


    public function search()
    {

    }

}