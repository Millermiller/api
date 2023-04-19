<?php

namespace Scandinaver\Learning\Asset\Domain\Event\Notifications;

use Ramsey\Uuid\UuidInterface;
use Scandinaver\Core\Infrastructure\CrossDomainEvent;

/**
 *
 */
class AssetCreatedNotification extends CrossDomainEvent
{
    public function __construct(private readonly UuidInterface $assetId, private readonly int $userId)
    {
    }

    public function getAssetId(): UuidInterface
    {
        return $this->assetId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}