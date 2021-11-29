<?php


namespace Scandinaver\Learning\Asset\Domain\Event;

use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Core\Domain\Contract\DomainEvent;

/**
 * Class AssetDeleted
 *
 * @package Scandinaver\Learn\Domain\Event
 */
class AssetDeleted implements DomainEvent
{
    public Asset $asset;

    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function getAsset(): Asset
    {
        return $this->asset;
    }
}
