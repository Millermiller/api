<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\RoleQuery;
use Scandinaver\RBAC\UI\Resource\RoleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class RoleQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class RoleQueryHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  RoleQuery|BaseCommandInterface  $query
     *
     * @throws RoleNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $role = $this->service->getRole($query->getId());

        $this->resource = new Item($role, new RoleTransformer());
    }
} 