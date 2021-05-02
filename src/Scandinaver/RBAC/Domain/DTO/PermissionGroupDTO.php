<?php


namespace Scandinaver\RBAC\Domain\DTO;

use Scandinaver\RBAC\Domain\Permission\PermissionGroup;
use Scandinaver\Shared\DTO;

/**
 * Class PermissionGroupDTO
 *
 * @package Scandinaver\RBAC\Domain\Model
 */
class PermissionGroupDTO extends DTO
{
    private PermissionGroup $permissionGroup;

    public function __construct(PermissionGroup $permissionGroup)
    {
        $this->permissionGroup = $permissionGroup;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'          => $this->permissionGroup->getId(),
            'name'        => $this->permissionGroup->getName(),
            'slug'        => $this->permissionGroup->getSlug(),
            'description' => $this->permissionGroup->getDescription(),
        ];
    }

}