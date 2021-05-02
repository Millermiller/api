<?php


namespace App\Http\Controllers\RBAC;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scandinaver\RBAC\Domain\Permissions\Permission;
use Scandinaver\RBAC\UI\Command\CreatePermissionCommand;
use Scandinaver\RBAC\UI\Command\DeletePermissionCommand;
use Scandinaver\RBAC\UI\Command\UpdatePermissionCommand;
use Scandinaver\RBAC\UI\Query\PermissionQuery;
use Scandinaver\RBAC\UI\Query\PermissionsQuery;
use Scandinaver\Shared\EventBusNotFoundException;

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
     */
    public function index(): JsonResponse
    {
        Gate::authorize(Permission::VIEW);

        return $this->execute(new PermissionsQuery());
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(int $id): JsonResponse
    {
        Gate::authorize(Permission::SHOW, $id);

        return $this->execute(new PermissionQuery($id));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): JsonResponse
    {
        Gate::authorize(Permission::DELETE, $id);

        return $this->execute(new DeletePermissionCommand($id), JsonResponse::HTTP_NO_CONTENT);
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): JsonResponse
    {
        Gate::authorize(Permission::CREATE);

        return $this->execute(new CreatePermissionCommand($request->toArray()), JsonResponse::HTTP_CREATED);
    }

    /**
     * @param  Request  $request
     * @param  int      $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        Gate::authorize(Permission::UPDATE, $id);

        return $this->execute(new UpdatePermissionCommand($id, $request->toArray()));
    }


    public function search()
    {
    }

}