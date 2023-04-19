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

    public function __construct(private User $user)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}