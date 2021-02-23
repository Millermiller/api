<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use Scandinaver\RBAC\Domain\Contract\Query\RolesHandlerInterface;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\RolesQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class RolesHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class RolesHandler implements RolesHandlerInterface
{
    private RBACService $service;

    public function __construct(RBACService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  RolesQuery|Query  $query
     *
     * @return array
     */
    public function handle(Query $query): array
    {
        return $this->service->getAllRoles();
    }
} 