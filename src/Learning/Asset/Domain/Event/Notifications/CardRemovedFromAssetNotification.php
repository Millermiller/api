<?php

namespace Scandinaver\Learning\Asset\Domain\Event\Notifications;

use Scandinaver\Core\Infrastructure\CrossDomainEvent;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;

/**
 * Class CardRemovedFromAssetNotification
 *
 * @package Scandinaver\Learning\Asset\Domain\Event\Notifications
 */
class CardRemovedFromAssetNotification extends CrossDomainEvent
{

    public function __construct(
        private readonly string $assetId,
        private readonly int    $userId,
        private readonly string $cardId
    ) {
    }

    public function getAssetId(): string
    {
        return $this->assetId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCardId(): int
    {
        return $this->cardId;
    }
}