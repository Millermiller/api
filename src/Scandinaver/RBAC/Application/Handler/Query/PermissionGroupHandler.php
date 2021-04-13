<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Contract\Query\PermissionGroupHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionGroupQuery;
use Scandinaver\RBAC\UI\Resources\PermissionGroupTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PermissionGroupHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionGroupHandler extends AbstractHandler implements PermissionGroupHandlerInterface
{
    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  PermissionGroupQuery|Query  $query
     *
     * @throws PermissionGroupNotFoundException
     */
    public function handle($query): void
    {
        $permissionGroup = $this->service->getPermissionGroup($query->getId());

        $this->resource = new Item($permissionGroup, new PermissionGroupTransformer());
    }
} 