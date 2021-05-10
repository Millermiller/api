<?php


namespace Scandinaver\RBAC\Domain\Service;

use Scandinaver\RBAC\Domain\DTO\PermissionGroupDTO;
use Scandinaver\RBAC\Domain\Model\PermissionGroup;

/**
 * Class PermissionFactory
 *
 * @package Scandinaver\RBAC\Domain\Services
 */
class PermissionGroupFactory
{

    public function fromDTO(PermissionGroupDTO $permissionGroupDTO): PermissionGroup
    {
        $permissionGroup = new PermissionGroup();
        $permissionGroup->setName($permissionGroupDTO->getName());
        $permissionGroup->setSlug($permissionGroupDTO->getSlug());
        $permissionGroup->setDescription($permissionGroupDTO->getDescription());

        return $permissionGroup;
    }
}