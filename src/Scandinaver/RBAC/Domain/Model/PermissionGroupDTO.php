<?php


namespace Scandinaver\RBAC\Domain\Model;


use Scandinaver\Shared\DTO;

class PermissionGroupDTO extends DTO
{

    private PermissionGroup $permissionGroup;

    public function __construct(PermissionGroup $permissionGroup)
    {
        $this->permissionGroup = $permissionGroup;
    }

    public function jsonSerialize()
    {
        return [
          'id' => $this->permissionGroup->getId(),
          'name' => $this->permissionGroup->getName(),
          'slug' => $this->permissionGroup->getSlug(),
          'description' => $this->permissionGroup->getDescription(),
        ];
    }

}