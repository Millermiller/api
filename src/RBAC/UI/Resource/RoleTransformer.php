<?php


namespace Scandinaver\RBAC\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Scandinaver\RBAC\Domain\Entity\Role;

/**
 * Class PermissionTransformer
 *
 * @package Scandinaver\RBAC\UI\Resource
 */
class RoleTransformer extends TransformerAbstract
{

    protected array $defaultIncludes = [
        'permissions',
    ];

    #[Pure]
    #[ArrayShape([
        'id'          => "int",
        'name'        => "string",
        'slug'        => "string",
        'description' => "null|string",
    ])]
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

        return $this->collection($permissions, new PermissionTransformer(), 'permissions');
    }
}