<?php


namespace Scandinaver\RBAC\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class RoleDTO
 *
 * @package Scandinaver\RBAC\Domain\Model
 */
class PermissionDTO extends DTO
{

    private Permission $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->permission->getId(),
            'title' => $this->permission->getName(),
            'slug' => $this->permission->getSlug(),
            'description' => $this->permission->getDescription(),
        ];
    }
}