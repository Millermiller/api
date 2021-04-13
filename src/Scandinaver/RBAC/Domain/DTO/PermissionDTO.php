<?php


namespace Scandinaver\RBAC\Domain\DTO;

use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\RBAC\Domain\Model\PermissionGroup;
use Scandinaver\Shared\DTO;

/**
 * Class RoleDTO
 *
 * @package Scandinaver\RBAC\Domain\Model
 */
class PermissionDTO extends DTO
{
    private Permission $permission;

    private ?PermissionGroup $permissionGroup;

    public function __construct(Permission $permission)
    {
        $this->permission      = $permission;
        $this->permissionGroup = $permission->getGroup();
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'          => $this->permission->getId(),
            'name'        => $this->permission->getName(),
            'slug'        => $this->permission->getSlug(),
            'description' => $this->permission->getDescription(),
           // 'group'       => $this->permissionGroup ? $this->permissionGroup->toDTO() : NULL,
        ];
    }
}