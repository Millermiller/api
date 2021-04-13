<?php


namespace Scandinaver\RBAC\UI\Resources;

use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Scandinaver\RBAC\Domain\Model\Role;

/**
 * Class PermissionTransformer
 *
 * @package Scandinaver\RBAC\UI\Resources
 */
class RoleTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'permissions',
    ];

    public function transform(Role $role): array
    {
        return [
            'id'          => $role->getId(),
            'name'        => $role->getName(),
            'slug'        => $role->getSlug(),
            'description' => $role->getDescription(),
        ];
    }

    public function includePermissions(Role $role): ?Collection
    {
        $permissions = $role->getPermissions();

        return $this->collection($permissions, new PermissionTransformer());
    }
}