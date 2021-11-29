<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\RolesQuery;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class RolesQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class RolesQueryHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  RolesQuery|  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $roles = $this->service->getAllRoles();

        $this->resource = new Collection($roles, new RoleTransformer());
    }
} 