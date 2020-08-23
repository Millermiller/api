<?php


namespace Scandinaver\Learn\Domain\Events;


use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Shared\DomainEvent;

/**
 * Class AddCardToAssetEvent
 *
 * @package Scandinaver\Learn\Domain\Events
 */
class AddCardToAssetEvent extends DomainEvent
{
    private Asset $asset;

    private Card $card;

    public function __construct(Asset $asset, Card $card)
    {
        $this->asset = $asset;
        $this->card = $card;
    }

    public function getAsset(): Asset
    {
        return $this->asset;
    }

    public function getCard(): Card
    {
        return $this->card;
    }
}