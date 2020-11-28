<?php


namespace Scandinaver\RBAC\Domain\Services;


use Scandinaver\RBAC\Domain\Contract\Repository\PermissionRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\RBAC\Domain\Model\{Permission, Role, RoleDTO};
use Scandinaver\User\Domain\Model\User;

/**
 * Class RBACService
 *
 * @package Scandinaver\User\Domain\Services
 */
class RBACService
{

    private UserRepositoryInterface $userRepository;

    private PermissionRepositoryInterface $permissionRepository;

    private RoleRepositoryInterface $roleRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PermissionRepositoryInterface $permissionRepository,
        RoleRepositoryInterface $roleRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function createRole(array $data): RoleDTO
    {
        $role = new Role();
        $role->setName($data['name']);
        $role->setSlug($data['slug']);
        $role->setDescription($data['description']);

        $this->roleRepository->save($role);

        return $role->toDTO();
    }

    public function updateRole(Role $role, array $data)
    {
        $this->roleRepository->update($role, $data);
    }

    public function deleteRole(Role $role): void
    {
        $role->delete();

        $this->roleRepository->delete($role);
    }

    public function createPermission(array $data)
    {
        $permission = new Permission();

        $this->permissionRepository->save($permission);
    }

    public function updatePermission(Permission $permission, array $data)
    {
        $this->permissionRepository->update($permission, $data);
    }

    public function deletePermission(Permission $permission): void
    {
        $permission->delete();

        $this->permissionRepository->delete($permission);
    }

    public function attachPermissionToRole(Role $role, Permission $permission)
    {
        $role->attachPermission($permission);

        $this->roleRepository->save($role);
    }

    public function detachPermissionFromRole(Role $role, Permission $permission)
    {
        $role->detachPermission($permission);

        $this->roleRepository->save($role);
    }

    public function attachPermissionToUser(User $user, Permission $permission)
    {
        $user->allow($permission);

        $this->userRepository->save($user);
    }

    public function detachPermissionFromUser(User $user, Permission $permission)
    {
        $user->deny($permission);

        $this->userRepository->save($user);
    }

    public function attachRoleToUser(User $user, Role $role)
    {
        $user->attachRole($role);

        $this->userRepository->save($user);
    }

    public function detachRoleFromUser(User $user, Role $role)
    {
        $user->detachRole($role);

        $this->userRepository->save($user);
    }
}