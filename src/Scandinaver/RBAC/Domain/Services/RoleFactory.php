<?php


namespace Scandinaver\RBAC\Domain\Services;


use Scandinaver\RBAC\Domain\Model\Role;

/**
 * Class RoleFactory
 *
 * @package Scandinaver\RBAC\Domain\Services
 */
class RoleFactory
{
    public static function build(array $data): Role
    {
        $role = new Role();
        $role->setName($data['name']);
        $role->setSlug($data['slug']);
        $role->setDescription($data['description']);

        return $role;
    }
}