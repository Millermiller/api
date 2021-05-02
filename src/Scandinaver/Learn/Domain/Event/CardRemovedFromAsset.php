<?php


namespace Scandinaver\Learn\Domain\Event;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Shared\DomainEvent;

/**
 * Class CardRemovedFromAsset
 *
 * @package Scandinaver\Learn\Domain\Event
 */
class CardRemovedFromAsset implements DomainEvent
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