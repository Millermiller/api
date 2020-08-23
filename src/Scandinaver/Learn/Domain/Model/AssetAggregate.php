<?php


namespace Scandinaver\Learn\Domain\Model;


use Scandinaver\Learn\Domain\Events\AddCardToAssetEvent;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class AssetAggregate
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class AssetAggregate extends AggregateRoot
{
    private array $cards;

    /**
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * @param  Card  $cards
     */
    public function addCard(Card $card): void
    {
        $this->cards[] = $card;
        $this->pushEvent(new AddCardToAssetEvent($this, $card));
    }
}