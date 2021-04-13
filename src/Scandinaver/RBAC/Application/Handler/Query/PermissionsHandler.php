<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Contract\Query\PermissionsHandlerInterface;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionsQuery;
use Scandinaver\RBAC\UI\Resources\PermissionTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PermissionsHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionsHandler extends AbstractHandler implements PermissionsHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  PermissionsQuery|Query  $query
     */
    public function handle($query): void
    {
        $permissions = $this->service->getAllPermissions();

        $this->fractal->parseIncludes('group');

        $this->resource = new Collection($permissions, new PermissionTransformer());
    }
} 