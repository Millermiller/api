<?php


namespace Scandinaver\RBAC\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\RBAC\Domain\Entity\PermissionGroup;

/**
 * Class PermissionGroupTransformer
 *
 * @package Scandinaver\RBAC\UI\Resource
 */
class PermissionGroupTransformer extends TransformerAbstract
{

    public function transform(PermissionGroup $permissionGroup): array
    {
        return [
            'id'          => $permissionGroup->getId(),
            'name'        => $permissionGroup->getName(),
            'slug'        => $permissionGroup->getSlug(),
            'description' => $permissionGroup->getDescription(),
        ];
    }
}