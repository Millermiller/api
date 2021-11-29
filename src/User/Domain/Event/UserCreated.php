<?php


namespace Scandinaver\User\Domain\Event;

use Scandinaver\Core\Domain\Contract\DomainEvent;
use Scandinaver\User\Domain\Entity\User;

/**
 * Class UserCreated
 *
 * @package Scandinaver\User\Domain\Event
 *
 */
class UserCreated implements DomainEvent
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}