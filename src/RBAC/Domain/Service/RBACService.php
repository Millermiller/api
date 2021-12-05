<?php


namespace Scandinaver\RBAC\Domain\Service;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionGroupRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\RBAC\Domain\DTO\PermissionDTO;
use Scandinaver\RBAC\Domain\DTO\PermissionGroupDTO;
use Scandinaver\RBAC\Domain\DTO\RoleDTO;
use Scandinaver\RBAC\Domain\Exception\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupDublicateException;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Exception\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exception\RoleDublicateException;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Entity\{Permission, PermissionGroup, Role};
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;

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

    private PermissionFactory $permissionFactory;

    private PermissionGroupFactory $permissionGroupFactory;

    private RoleFactory $roleFactory;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PermissionRepositoryInterface $permissionRepository,
        RoleRepositoryInterface $roleRepository,
        PermissionGroupRepositoryInterface $permissionGroupRepository,
        PermissionFactory $permissionFactory,
        PermissionGroupFactory $permissionGroupFactory,
        RoleFactory $roleFactory
    ) {
        $this->userRepository            = $userRepository;
        $this->permissionRepository      = $permissionRepository;
        $this->permissionGroupRepository = $permissionGroupRepository;
        $this->roleRepository            = $roleRepository;
        $this->permissionFactory         = $permissionFactory;
        $this->permissionGroupFactory    = $permissionGroupFactory;
        $this->roleFactory               = $roleFactory;
    }


    public function getAllRoles(RequestParametersComposition $parameters): LengthAwarePaginator
    {
        return $this->roleRepository->getData($parameters);
    }

    public function getAllPermissions(RequestParametersComposition $parameters): LengthAwarePaginator
    {
        return $this->permissionRepository->getData($parameters);
    }

    public function getAllPermissionGroups(RequestParametersComposition $parameters): LengthAwarePaginator
    {
        return $this->permissionGroupRepository->getData($parameters);
    }

    /**
     * @param  RoleDTO  $roleDTO
     *
     * @return Role
     * @throws RoleDublicateException
     */
    public function createRole(RoleDTO $roleDTO): Role
    {
        $role = $this->roleFactory->fromDTO($roleDTO);

        $isDuplicate = $this->roleRepository->findOneBy(
            [
                'slug' => $role->getSlug(),
            ]
        );

        if ($isDuplicate !== NULL) {
            throw new RoleDublicateException();
        }

        $this->roleRepository->save($role);

        return $role;
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @return Role
     * @throws RoleNotFoundException
     */
    public function updateRole(int $id, array $data): Role
    {
        $role = $this->getRole($id);

        $this->roleRepository->update($role, $data);

        return $role;
    }

    /**
     * @param  int  $id
     *
     * @throws RoleNotFoundException
     */
    public function deleteRole(int $id): void
    {
        $role = $this->getRole($id);

        $this->roleRepository->delete($role);
    }

    /**
     * @param  PermissionDTO  $permissionDTO
     *
     * @return Permission
     * @throws PermissionDublicateException|PermissionGroupNotFoundException
     */
    public function createPermission(PermissionDTO $permissionDTO): Permission
    {
        $permission = $this->permissionFactory->fromDTO($permissionDTO);

        $isDuplicate = $this->permissionRepository->findOneBy(
            [
                'slug' => $permission->getSlug(),
            ]
        );

        if ($isDuplicate !== NULL) {
            throw new PermissionDublicateException();
        }

        $this->permissionRepository->save($permission);

        return $permission;
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @return Permission
     * @throws PermissionNotFoundException|PermissionGroupNotFoundException
     */
    public function updatePermission(int $id, array $data): Permission
    {
        $permission = $this->getPermission($id);

        $groupId = $data['group'];
        if ($groupId) {
            $permissionGroup = $this->getPermissionGroup($groupId);
            $permission->setGroup($permissionGroup);
        }

        $permission->setName($data['name']);
        $permission->setSlug($data['slug']);
        $permission->setDescription($data['description']);

        $this->permissionRepository->save($permission);

        return $permission;
    }

    /**
     * @param  int  $id
     *
     * @throws PermissionNotFoundException
     */
    public function deletePermission(int $id): void
    {
        $permission = $this->getPermission($id);

        $this->permissionRepository->delete($permission);
    }


    /**
     * @param  PermissionGroupDTO  $permissionGroupDTO
     *
     * @return PermissionGroup
     * @throws PermissionGroupDublicateException
     */
    public function createPermissionGroup(PermissionGroupDTO $permissionGroupDTO): PermissionGroup
    {
        $permissionGroup = $this->permissionGroupFactory->fromDTO($permissionGroupDTO);

        $isDuplicate = $this->permissionGroupRepository->findOneBy(
            [
                'slug' => $permissionGroup->getSlug(),
            ]
        );

        if ($isDuplicate !== NULL) {
            throw new PermissionGroupDublicateException();
        }

        $this->permissionGroupRepository->save($permissionGroup);

        return $permissionGroup;
    }

    /**
     * @param  int    $id
     * @param  array  $data
     *
     * @return PermissionGroup
     * @throws PermissionGroupNotFoundException
     * @throws PermissionGroupDublicateException
     */
    public function updatePermissionGroup(int $id, array $data): PermissionGroup
    {
        $permissionGroup = $this->getPermissionGroup($id);

        // TODO: сделать нормальную проверку дубликатов
        $isDuplicate = $this->permissionGroupRepository->findOneBy(
            [
                'slug' => $data['slug'],
            ]
        );

        if ($isDuplicate !== NULL && $isDuplicate->getId() !== $permissionGroup->getId()) {
            throw new PermissionGroupDublicateException();
        }

        $this->permissionGroupRepository->update($permissionGroup, $data);

        return $permissionGroup;
    }

    /**
     * @param  int  $id
     *
     * @throws PermissionGroupNotFoundException
     */
    public function deletePermissionGroup(int $id): void
    {
        $permissionGroup = $this->getPermissionGroup($id);

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
    public function attachPermissionToRole(int $roleId, int $permissionId): void
    {
        $role       = $this->getRole($roleId);
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
        $role       = $this->getRole($roleId);
        $permission = $this->getPermission($permissionId);

        $role->detachPermission($permission);

        $this->roleRepository->save($role);
    }

    /**
     * @param  UserInterface  $user
     * @param  Permission     $permission
     *
     * @throws Exception
     */
    public function attachPermissionToUser(UserInterface $user, Permission $permission)
    {
        $user->allow($permission);

        $this->userRepository->save($user);
    }

    /**
     * @param  UserInterface  $user
     * @param  Permission     $permission
     *
     * @throws Exception
     */
    public function detachPermissionFromUser(UserInterface $user, Permission $permission)
    {
        $user->deny($permission);

        $this->userRepository->save($user);
    }

    /**
     * @param  UserInterface  $user
     * @param  Role           $role
     *
     * @throws Exception
     */
    public function attachRoleToUser(UserInterface $user, Role $role)
    {
        $user->attachRole($role);

        $this->userRepository->save($user);
    }

    /**
     * @param  UserInterface  $user
     * @param  Role           $role
     *
     * @throws Exception
     */
    public function detachRoleFromUser(UserInterface $user, Role $role)
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
    public function getRole(int $id): Role
    {
        $role = $this->roleRepository->find($id);
        if ($role === NULL) {
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
    public function getPermission(int $id): Permission
    {
        $permission = $this->permissionRepository->find($id);
        if ($permission === NULL) {
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
    public function getPermissionGroup(int $id): PermissionGroup
    {
        $permissionGroup = $this->permissionGroupRepository->find($id);
        if ($permissionGroup === NULL) {
            throw new PermissionGroupNotFoundException();
        }

        return $permissionGroup;
    }
}