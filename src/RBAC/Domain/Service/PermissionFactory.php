<?php


namespace Scandinaver\RBAC\Domain\Service;


use Scandinaver\RBAC\Domain\Contract\Repository\PermissionGroupRepositoryInterface;
use Scandinaver\RBAC\Domain\DTO\PermissionDTO;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Entity\Permission;
use Scandinaver\RBAC\Domain\Entity\PermissionGroup;

/**
 * Class PermissionFactory
 *
 * @package Scandinaver\RBAC\Domain\Services
 */
class PermissionFactory
{

    /**
     * @var PermissionGroupRepositoryInterface
     */
    private PermissionGroupRepositoryInterface $permissionGroupRepository;

    public function __construct(PermissionGroupRepositoryInterface $permissionGroupRepository)
    {
        $this->permissionGroupRepository = $permissionGroupRepository;
    }

    /**
     * @param  PermissionDTO  $permissionDTO
     *
     * @return Permission
     * @throws PermissionGroupNotFoundException
     */
    public function fromDTO(PermissionDTO $permissionDTO): Permission
    {
        $permissionGroupId = $permissionDTO->getGroupId();

        $permissionGroup = $this->permissionGroupRepository->find($permissionGroupId);
        if ($permissionGroup === NULL) {
            throw new PermissionGroupNotFoundException();
        }

        $permission = new Permission($permissionDTO->getSlug());
        $permission->setName($permissionDTO->getName());
        $permission->setGroup($permissionGroup);
        $permission->setDescription($permissionDTO->getDescription());

        return $permission;
    }
}