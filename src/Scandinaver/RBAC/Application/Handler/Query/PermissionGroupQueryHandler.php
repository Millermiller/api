<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionGroupQuery;
use Scandinaver\RBAC\UI\Resource\PermissionGroupTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class PermissionGroupQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionGroupQueryHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  PermissionGroupQuery|BaseCommandInterface  $query
     *
     * @throws PermissionGroupNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $permissionGroup = $this->service->getPermissionGroup($query->getId());

        $this->resource = new Item($permissionGroup, new PermissionGroupTransformer());
    }
} 