<?php

namespace Scandinaver\Learning\Asset\Domain\Event\Notifications;

use Scandinaver\Core\Infrastructure\CrossDomainEvent;

/**
 * Class AssetDeletedNotification
 *
 * @package Scandinaver\Learning\Asset\Domain\Event\Notifications
 */
class AssetDeletedNotification extends CrossDomainEvent
{
    public function __construct(private readonly string $id, private readonly int $userId)
    {
    }

    public function getAssetId(): string
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}