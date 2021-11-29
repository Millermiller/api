<?php


namespace Scandinaver\RBAC\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\TransformerAbstract;
use Scandinaver\RBAC\Domain\Entity\PermissionGroup;

/**
 * Class PermissionGroupTransformer
 *
 * @package Scandinaver\RBAC\UI\Resource
 */
class PermissionGroupTransformer extends TransformerAbstract
{

    #[ArrayShape([
        'id'          => "int",
        'name'        => "string",
        'slug'        => "string",
        'description' => "null|string",
    ])]
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