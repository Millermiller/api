<?php


namespace App\Http\Controllers\RBAC;


use App\Http\Controllers\Controller;
use Exception;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\RBAC\UI\Command\CreatePermissionCommand;
use Scandinaver\RBAC\UI\Command\DeletePermissionCommand;
use Scandinaver\RBAC\UI\Command\UpdatePermissionCommand;
use Scandinaver\RBAC\UI\Query\PermissionQuery;
use Scandinaver\RBAC\UI\Query\PermissionsQuery;

/**
 * Class RoleController
 *
 * @package App\Http\Controllers\RBAC
 */
class PermissionController extends Controller
{

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        Gate::authorize('view-permissions');

        return $this->execute(new PermissionsQuery());
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
        Gate::authorize('show-permission');

        return $this->execute(new PermissionQuery($id));
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
        Gate::authorize('delete-permission', $id);

        return $this->execute(new DeletePermissionCommand($id));
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
        Gate::authorize('create-permission');

        return $this->execute(new CreatePermissionCommand($request->toArray()));
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
        Gate::authorize('update-permission', $id);

        return $this->execute(new UpdatePermissionCommand($id,
          $request->toArray()));
    }


    public function search()
    {

    }

}