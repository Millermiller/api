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
        $permission = new Permission();
        $permission->setName($data['title']);
        $permission->setSlug($data['slug']);
        $permission->setDescription($data['description']);

        return $permission;
    }
}