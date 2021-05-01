<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionQuery;
use Scandinaver\RBAC\UI\Resources\PermissionTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PermissionQueryHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionQueryHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  PermissionQuery|CommandInterface  $query
     *
     * @throws PermissionNotFoundException
     */
    public function handle(CommandInterface $query): void
    {
        $permission = $this->service->getPermission($query->getId());

        $this->fractal->parseIncludes('group');

        $this->resource = new Item($permission, new PermissionTransformer());
    }
} 