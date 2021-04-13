<?php


namespace Scandinaver\RBAC\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\RBAC\Domain\Model\PermissionGroup;

/**
 * Class PermissionGroupTransformer
 *
 * @package Scandinaver\RBAC\UI\Resources
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