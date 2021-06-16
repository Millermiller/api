<?php


namespace Scandinaver\Learn\Domain\Event;

use Scandinaver\Learn\Domain\Entity\Asset;
use Scandinaver\Shared\DomainEvent;

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
