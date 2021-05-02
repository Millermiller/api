<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\RolesQuery;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class RolesQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class RolesQueryHandler extends AbstractHandler
{
    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  RolesQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        $roles = $this->service->getAllRoles();

        $this->resource = new Collection($roles, new RoleTransformer());
    }
} 