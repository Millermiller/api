<?php


namespace Scandinaver\User\Domain\Model;


use Scandinaver\Shared\DTO;

class UserDTO extends DTO
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function jsonSerialize()
    {
        return [
          'id' => $this->user->getKey(),
          'login' => $this->user->getLogin(),
          'avatar' => $this->user->getAvatar(),
          'email' => $this->user->getEmail(),
          'active' => $this->user->getActive(),
          'plan' => $this->user->getPlan(),
          'active_to' => $this->user->getActiveTo()->format('Y-m-d H:i:s'),
          'roles' => $this->user->getRoles()->map(
            fn($role) => $role->toDTO()
          )->toArray(),
          'permissions' => $this->user->getAllPermissions()->map(
            fn($permission) => $permission->toDTO()
          )->toArray(),
        ];
    }
}