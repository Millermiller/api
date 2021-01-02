<?php


namespace Scandinaver\RBAC\Application\Handler\Query;

use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Model\PermissionDTO;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Query\PermissionQuery;
use Scandinaver\RBAC\Domain\Contract\Query\PermissionHandlerInterface;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PermissionHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Query
 */
class PermissionHandler implements PermissionHandlerInterface
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {

        $this->service = $service;
    }

    /**
     * @param  PermissionQuery|Query  $query
     *
     * @return PermissionDTO
     * @throws PermissionNotFoundException
     */
    public function handle($query): PermissionDTO
    {
        return $this->service->getPermission($query->getId())->toDTO();
    }
} 