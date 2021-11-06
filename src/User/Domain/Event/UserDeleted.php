<?php


namespace Scandinaver\User\Domain\Event;

use Scandinaver\Shared\DomainEvent;
use Scandinaver\User\Domain\Entity\User;

/**
 * Class UserDeleted
 *
 * @package Scandinaver\User\Domain\Event
 *
 */
class UserDeleted implements DomainEvent
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