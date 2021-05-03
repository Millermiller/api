<?php


namespace Scandinaver\User\Domain\Event;

use Scandinaver\Shared\DomainEvent;
use Scandinaver\User\Domain\Model\User;

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