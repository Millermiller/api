<?php


namespace Scandinaver\RBAC\Domain\Services;


use Scandinaver\RBAC\Domain\Contract\Repository\PermissionRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exceptions\RoleDublicateException;
use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\RBAC\Domain\Model\{Permission, PermissionDTO, Role, RoleDTO};
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


    public function getAllRoles(): array
    {
        $result = [];
        $roles = $this->roleRepository->all();

        /** @var Role $role */
        foreach ($roles as $role) {
            $result[] = $role->toDTO();
        }

        return $result;
    }

    public function getAllPermissions(): array
    {
        $result = [];
        $permissions = $this->permissionRepository->all();

        /** @var Permission $permission */
        foreach ($permissions as $permission) {
            $result[] = $permission->toDTO();
        }

        return $result;
    }

    public function createRole(array $data): RoleDTO
    {
        $role = RoleFactory::build($data);

        $isDublicate = $this->roleRepository->findOneBy(
            [
                'slug' => $data['slug'],
            ]
        );

        if ($isDublicate !== null) {
            throw new RoleDublicateException();
        }

        $this->roleRepository->save($role);

        return $role->toDTO();
    }

    public function updateRole(int $id, array $data)
    {
        $role = $this->getRole($id);

        $this->roleRepository->update($role, $data);
    }

    public function deleteRole(int $id): void
    {
        $role = $this->getRole($id);

        $role->delete();

        $this->roleRepository->delete($role);
    }

    public function createPermission(array $data): PermissionDTO
    {
        $permission = PermissionFactory::build($data);

        $isDublicate = $this->permissionRepository->findOneBy(
            [
                'slug' => $data['slug'],
            ]
        );

        if ($isDublicate !== null) {
            throw new PermissionDublicateException();
        }

        $this->permissionRepository->save($permission);

        return $permission->toDTO();
    }

    public function updatePermission(int $id, array $data)
    {
        $permission = $this->getPermission($id);

        $this->permissionRepository->update($permission, $data);
    }

    public function deletePermission(int $id): void
    {
        $permission = $this->getPermission($id);

        $permission->delete();

        $this->permissionRepository->delete($permission);
    }

    public function attachPermissionToRole(int $roleId, int $permissionId)
    {
        $role = $this->getRole($roleId);
        $permission = $this->getPermission($permissionId);

        $role->attachPermission($permission);

        $this->roleRepository->save($role);
    }

    public function detachPermissionFromRole(int $roleId, int $permissionId)
    {
        $role = $this->getRole($roleId);
        $permission = $this->getPermission($permissionId);

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

    private function getRole(int $id): Role {

        /** @var Role $role */
        $role = $this->roleRepository->find($id);
        if ($role === null) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

    private function getPermission(int $id): Permission {

        /** @var Permission $permission */
        $permission = $this->permissionRepository->find($id);
        if ($permission === null) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }
}