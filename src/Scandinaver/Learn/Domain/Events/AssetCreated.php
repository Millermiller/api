<?php


namespace Scandinaver\Learn\Domain\Events;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\DomainEvent;

/**
 * Class AssetCreated
 *
 * @package Scandinaver\Learn\Domain\Events
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
