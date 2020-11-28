<?php


namespace Scandinaver\RBAC\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class RoleDTO
 *
 * @package Scandinaver\User\Domain\Model
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
        // TODO: Implement jsonSerialize() method.
    }
}