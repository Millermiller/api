<?php


namespace Scandinaver\User\Domain\Service;

use Exception;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\RBAC\Domain\Entity\Role;
use Scandinaver\User\Domain\DTO\UserDTO;
use Scandinaver\User\Domain\Entity\User;

/**
 * Class UserFactory
 *
 * @package Scandinaver\User\Domain\Service
 */
class UserFactory
{

    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param  UserDTO  $userDTO
     *
     * @return User
     * @throws Exception
     */
    public function fromDTO(UserDTO $userDTO): User
    {
        $user = new User();
        $user->setLogin($userDTO->getLogin());
        $user->setEmail($userDTO->getEmail());
        $user->setPassword(bcrypt($userDTO->getPassword()));

        $user->setActiveTo(new \DateTime('+1 month'));

        $rolesDTO = $userDTO->getRoles();

        if ($rolesDTO === []) {
            $defaultRole = $this->roleRepository->findOneBy([
                'slug' => 'user',
            ]);

            if ($defaultRole === NULL) {
                throw new Exception('Default role not found');
            }

            $user->attachRole($defaultRole);
        }

        foreach ($rolesDTO as $roleDTO) {
            $role = $this->roleRepository->find($roleDTO->getId());
            $user->attachRole($role);
        }

        return $user;
    }

    public function toDTO()
    {

    }
}