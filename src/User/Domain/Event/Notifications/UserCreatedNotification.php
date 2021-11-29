<?php


namespace Scandinaver\User\Domain\Event\Notifications;


use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Infrastructure\CrossDomainEvent;

/**
 * Class UserCreatedNotification
 *
 * @package Scandinaver\User\Domain\Event\Notifications
 */
class UserCreatedNotification extends CrossDomainEvent
{
    public function __construct(private UserInterface $user)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}