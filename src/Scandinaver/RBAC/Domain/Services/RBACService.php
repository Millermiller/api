<?php


namespace Scandinaver\RBAC\Domain\Services;


use Exception;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionGroupRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\RBAC\Domain\Exceptions\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupDublicateException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exceptions\RoleDublicateException;
use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\RBAC\Domain\Model\{Permission, PermissionDTO, PermissionGroup, PermissionGroupDTO, Role, RoleDTO};
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

    private PermissionGroupRepositoryInterface $permissionGroupRepository;

    public function __construct(
      UserRepositoryInterface $userRepository,
      PermissionRepositoryInterface $permissionRepository,
      RoleRepositoryInterface $roleRepository,
      PermissionGroupRepositoryInterface $permissionGroupRepository
    ) {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
        $this->permissionGroupRepository = $permissionGroupRepository;
        $this->roleRepository = $roleRepository;
    }


    public function getAllRoles(): array
    {
        $result = [];
        $roles = $this->roleRepository->findAll();

        /** @var Role $role */
        foreach ($roles as $role) {
            $result[] = $role->toDTO();
        }

        return $result;
    }

    public function getAllPermissions(): array
    {
        $result = [];
        $permissions = $this->permissionRepository->findAll();

        /** @var Permission $permission */
        foreach ($permissions as $permission) {
            $result[] = $permission->toDTO();
        }

        return $result;
    }

    public function getAllPermissionGroups(): array
    {
        $result = [];
        $permissionsGroups = $this->permissionGroupRepository->findAll();

        /** @var PermissionGroup $permissionsGroup */
        foreach ($permissionsGroups as $permissionsGroup) {
            $result[] = $permissionsGroup->toDTO();
        }

        return $result;
    }

    /**
     * @param  array  $data
     *
     * @return RoleDTO
     * @throws RoleDublicateException
     */
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

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @throws RoleNotFoundException
     */
    public function updateRole(int $id, array $data)
    {
        $role = $this->getRole($id);

        $this->roleRepository->update($role, $data);
    }

    /**
     * @param  int  $id
     *
     * @throws RoleNotFoundException
     */
    public function deleteRole(int $id): void
    {
        $role = $this->getRole($id);

        $role->delete();

        $this->roleRepository->delete($role);
    }

    /**
     * @param  array  $data
     *
     * @return PermissionDTO
     * @throws PermissionDublicateException|PermissionGroupNotFoundException
     */
    public function createPermission(array $data): PermissionDTO
    {
        $groupId = $data['group'];
        if($groupId) {
            $data['group'] = $this->getPermissionGroup($groupId);
        }

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

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @throws PermissionNotFoundException|PermissionGroupNotFoundException
     */
    public function updatePermission(int $id, array $data)
    {
        $permission = $this->getPermission($id);

        $groupId = $data['group'];
        if($groupId) {
            $permissionGroup = $this->getPermissionGroup($groupId);
            $permission->setGroup($permissionGroup);
        }

        $permission->setName($data['name']);
        $permission->setSlug($data['slug']);
        $permission->setDescription($data['description']);

        $this->permissionRepository->save($permission);
    }

    /**
     * @param  int  $id
     *
     * @throws PermissionNotFoundException
     */
    public function deletePermission(int $id): void
    {
        $permission = $this->getPermission($id);

        $permission->delete();

        $this->permissionRepository->delete($permission);
    }


    /**
     * @param  array  $data
     *
     * @return PermissionGroupDTO
     * @throws PermissionGroupDublicateException
     */
    public function createPermissionGroup(array $data): PermissionGroupDTO
    {
        $permissionGroup = PermissionGroupFactory::build($data);

        $isDublicate = $this->permissionGroupRepository->findOneBy(
          [
            'slug' => $data['slug'],
          ]
        );

        if ($isDublicate !== null) {
            throw new PermissionGroupDublicateException();
        }

        $this->permissionGroupRepository->save($permissionGroup);

        return $permissionGroup->toDTO();
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @throws PermissionGroupNotFoundException
     */
    public function updatePermissionGroup(int $id, array $data)
    {
        $permissionGroup = $this->getPermissionGroup($id);

        $this->permissionGroupRepository->update($permissionGroup, $data);
    }

    /**
     * @param  int  $id
     *
     * @throws PermissionGroupNotFoundException
     */
    public function deletePermissionGroup(int $id): void
    {
        $permissionGroup = $this->getPermissionGroup($id);

        $permissionGroup->delete();

        $this->permissionGroupRepository->delete($permissionGroup);
    }

    /**
     * @param  int  $roleId
     * @param  int  $permissionId
     *
     * @throws PermissionNotFoundException
     * @throws RoleNotFoundException
     * @throws Exception
     */
    public function attachPermissionToRole(int $roleId, int $permissionId)
    {
        $role = $this->getRole($roleId);
        $permission = $this->getPermission($permissionId);

        $role->attachPermission($permission);

        $this->roleRepository->save($role);
    }

    /**
     * @param  int  $roleId
     * @param  int  $permissionId
     *
     * @throws PermissionNotFoundException
     * @throws RoleNotFoundException
     * @throws Exception
     */
    public function detachPermissionFromRole(int $roleId, int $permissionId)
    {
        $role = $this->getRole($roleId);
        $permission = $this->getPermission($permissionId);

        $role->detachPermission($permission);

        $this->roleRepository->save($role);
    }

    /**
     * @param  User        $user
     * @param  Permission  $permission
     *
     * @throws Exception
     */
    public function attachPermissionToUser(User $user, Permission $permission)
    {
        $user->allow($permission);

        $this->userRepository->save($user);
    }

    /**
     * @param  User        $user
     * @param  Permission  $permission
     *
     * @throws Exception
     */
    public function detachPermissionFromUser(User $user, Permission $permission)
    {
        $user->deny($permission);

        $this->userRepository->save($user);
    }

    /**
     * @param  User  $user
     * @param  Role  $role
     *
     * @throws Exception
     */
    public function attachRoleToUser(User $user, Role $role)
    {
        $user->attachRole($role);

        $this->userRepository->save($user);
    }

    /**
     * @param  User  $user
     * @param  Role  $role
     *
     * @throws Exception
     */
    public function detachRoleFromUser(User $user, Role $role)
    {
        $user->detachRole($role);

        $this->userRepository->save($user);
    }

    /**
     * @param  int  $id
     *
     * @return Role
     * @throws RoleNotFoundException
     */
    private function getRole(int $id): Role
    {
        /** @var Role $role */
        $role = $this->roleRepository->find($id);
        if ($role === null) {
            throw new RoleNotFoundException();
        }

        return $role;
    }

    /**
     * @param  int  $id
     *
     * @return Permission
     * @throws PermissionNotFoundException
     */
    private function getPermission(int $id): Permission
    {
        /** @var Permission $permission */
        $permission = $this->permissionRepository->find($id);
        if ($permission === null) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }

    /**
     * @param  int  $id
     *
     * @return PermissionGroup
     * @throws PermissionGroupNotFoundException
     */
    private function getPermissionGroup(int $id): PermissionGroup
    {
        /** @var PermissionGroup $permissionGroup */
        $permissionGroup = $this->permissionGroupRepository->find($id);
        if ($permissionGroup === null) {
            throw new PermissionGroupNotFoundException();
        }

        return $permissionGroup;
    }
}