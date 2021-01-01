<?php


namespace Scandinaver\RBAC\Domain\Services;

use Scandinaver\RBAC\Domain\Model\PermissionGroup;
use Scandinaver\Shared\Contract\Factory;

/**
 * Class PermissionFactory
 *
 * @package Scandinaver\RBAC\Domain\Services
 */
class PermissionGroupFactory implements Factory
{
    public static function build(array $data): PermissionGroup
    {
        $permissionGroup = new PermissionGroup();
        $permissionGroup->setName($data['name']);
        $permissionGroup->setSlug($data['slug']);
        $permissionGroup->setDescription($data['description']);

        return $permissionGroup;
    }
}