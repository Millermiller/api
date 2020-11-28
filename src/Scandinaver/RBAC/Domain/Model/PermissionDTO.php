<?php


namespace Scandinaver\RBAC\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class RoleDTO
 *
 * @package Scandinaver\RBAC\Domain\Model
 */
class RoleDTO extends DTO
{

    private Role $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->role->getId(),
            'title' => $this->role->getName(),
            'slug' => $this->role->getSlug(),
            'description' => $this->role->getDescription(),
        ];
    }
}