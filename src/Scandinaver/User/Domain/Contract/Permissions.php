<?php


namespace Scandinaver\User\Domain\Contract;


use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\RBAC\Domain\Model\Role;

/**
 * Interface Permission
 *
 * @package Scandinaver\User\Domain\Contract
 */
interface Permissions
{

    public function attachRole(Role $role): void;

    public function detachRole(Role $role): void;

    public function allow(Permission $permission): void;

    public function deny(Permission $permission): void;

    public function hasRole(string $role): bool;

    public function can(string $permission): bool;
}