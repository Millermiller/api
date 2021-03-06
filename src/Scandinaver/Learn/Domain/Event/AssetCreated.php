<?php


namespace Scandinaver\Learn\Domain\Event;

use Scandinaver\Learn\Domain\Entity\Asset;
use Scandinaver\Shared\DomainEvent;

/**
 * Class AssetCreated
 *
 * @package Scandinaver\Learn\Domain\Event
 */
class AssetCreated implements DomainEvent
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
