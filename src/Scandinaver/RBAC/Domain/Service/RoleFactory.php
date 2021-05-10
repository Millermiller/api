<?php


namespace Scandinaver\RBAC\Domain\Service;

use Scandinaver\RBAC\Domain\DTO\RoleDTO;
use Scandinaver\RBAC\Domain\Model\Role;

/**
 * Class RoleFactory
 *
 * @package Scandinaver\RBAC\Domain\Services
 */
class RoleFactory
{

    public function fromDTO(RoleDTO $roleDTO): Role
    {
        $role = new Role();
        $role->setName($roleDTO->getName());
        $role->setSlug($roleDTO->getSlug());
        $role->setDescription($roleDTO->getDescription());

        return $role;
    }
}