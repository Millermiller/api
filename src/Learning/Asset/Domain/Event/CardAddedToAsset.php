<?php


namespace Scandinaver\Learning\Asset\Domain\Event;


use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Learning\Asset\Domain\Entity\Card;
use Scandinaver\Core\Domain\Contract\DomainEvent;

/**
 * Class AddCardToAssetEvent
 *
 * @package Scandinaver\Learn\Domain\Event
 */
class CardAddedToAsset implements DomainEvent
{
    private Asset $asset;

    private Card $card;

    public function __construct(Asset $asset, Card $card)
    {
        $this->asset = $asset;
        $this->card  = $card;
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