<?php


namespace App\Http\Controllers\RBAC;

use App\Http\Controllers\Controller;
use App\Http\Requests\RBAC\CreatePermissionRequest;
use App\Http\Requests\RBAC\UpdatePermissionRequest;
use Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Scandinaver\RBAC\Domain\Permission\Permission;
use Scandinaver\RBAC\UI\Command\CreatePermissionCommand;
use Scandinaver\RBAC\UI\Command\DeletePermissionCommand;
use Scandinaver\RBAC\UI\Command\UpdatePermissionCommand;
use Scandinaver\RBAC\UI\Query\PermissionQuery;
use Scandinaver\RBAC\UI\Query\PermissionsQuery;
use Symfony\Component\HttpFoundation\Response;

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
     * @param  CreatePermissionRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(CreatePermissionRequest $request): JsonResponse
    {
        Gate::authorize(Permission::CREATE);

        return $this->execute(new CreatePermissionCommand($request->toArray()), Response::HTTP_CREATED);
    }

    /**
     * @param  UpdatePermissionRequest  $request
     * @param  int                      $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UpdatePermissionRequest $request, int $id): JsonResponse
    {
        Gate::authorize(Permission::UPDATE, $id);

        return $this->execute(new UpdatePermissionCommand($id, $request->toArray()));
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

        return $this->execute(new DeletePermissionCommand($id), Response::HTTP_NO_CONTENT);
    }

    public function search()
    {
    }

}