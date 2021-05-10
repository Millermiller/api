<?php


namespace Scandinaver\RBAC\UI\Resource;


use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\RBAC\Domain\Model\Permission;

/**
 * Class PermissionTransformer
 *
 * @package Scandinaver\RBAC\UI\Resource
 */
class PermissionTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'group',
    ];

    public function transform(Permission $permission): array
    {
        return [
            'id'          => $permission->getId(),
            'name'        => $permission->getName(),
            'slug'        => $permission->getSlug(),
            'description' => $permission->getDescription(),
        ];
    }

    public function includeGroup(Permission $permission): ?Item
    {
        $permissionGroup = $permission->getGroup();

        if ($permissionGroup === NULL) {
            return NULL;
        }

        return $this->item($permissionGroup, new PermissionGroupTransformer());
    }
}