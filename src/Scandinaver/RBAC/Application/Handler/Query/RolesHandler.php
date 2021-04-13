<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Contract\Query\RolesHandlerInterface;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\RolesQuery;
use Scandinaver\RBAC\UI\Resources\RoleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class RolesHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class RolesHandler extends AbstractHandler implements RolesHandlerInterface
{
    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  RolesQuery|Query  $query
     */
    public function handle($query): void
    {
        $roles = $this->service->getAllRoles();

        $this->resource = new Collection($roles, new RoleTransformer());
    }
} 