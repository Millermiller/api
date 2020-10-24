<?php


namespace Scandinaver\Learn\Domain\Events;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\DomainEvent;

/**
 * Class AssetDeleted
 *
 * @package Scandinaver\Learn\Domain\Events
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
