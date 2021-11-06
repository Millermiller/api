<?php


namespace Scandinaver\User\Domain\DTO;

use Scandinaver\RBAC\Domain\DTO\RoleDTO;
use Scandinaver\Shared\DTO;

/**
 * Class UserDTO
 *
 * @package Scandinaver\User\Domain\Entity
 */
class UserDTO extends DTO
{
    private string $login;

    private string $password;

    private string $email;

    /** @var RoleDTO[] $roles */
    private array $roles;

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public static function fromArray(array $data): UserDTO
    {
        $userDTO = new self();

        $userDTO->setLogin($data['login']);
        $userDTO->setEmail($data['email']);
        $userDTO->setPassword($data['password']);

        $rolesDTO = [];

        $roles = $data['roles'];
        foreach ($roles as $role) {
            $rolesDTO[] = RoleDTO::fromArray($role);
        }

        $userDTO->setRoles($rolesDTO);

        return $userDTO;
    }
}