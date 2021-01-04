<?php


namespace Scandinaver\RBAC\Domain\Services;


use Scandinaver\RBAC\Domain\Model\Permission;

/**
 * Class PermissionFactory
 *
 * @package Scandinaver\RBAC\Domain\Services
 */
class PermissionFactory
{
    public static function build(array $data): Permission
    {
        $permission = new Permission($data['slug']);
        $permission->setName($data['name']);
        $permission->setGroup($data['group']);
        $permission->setDescription($data['description']);

        return $permission;
    }
}