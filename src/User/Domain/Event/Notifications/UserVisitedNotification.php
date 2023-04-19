<?php

namespace Scandinaver\User\Domain\Event\Notifications;


use Scandinaver\Core\Infrastructure\CrossDomainEvent;

/**
 *
 */
class UserVisitedNotification extends CrossDomainEvent
{
    public function __construct(private readonly int $userId)
    {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}