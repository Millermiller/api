<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Contract\Query\RoleHandlerInterface;
use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\RoleQuery;
use Scandinaver\RBAC\UI\Resources\RoleTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class RoleHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class RoleHandler extends AbstractHandler implements RoleHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  RoleQuery|Query  $query
     *
     * @throws RoleNotFoundException
     */
    public function handle($query): void
    {
        $role = $this->service->getRole($query->getId());

        $this->resource = new Item($role, new RoleTransformer());
    }
} 