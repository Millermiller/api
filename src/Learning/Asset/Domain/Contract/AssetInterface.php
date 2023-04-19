<?php


namespace Scandinaver\Learning\Asset\Domain\Contract;


use Doctrine\Common\Collections\Collection;
use Scandinaver\Learning\Asset\Domain\Entity\Card;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;

/**
 * Interface AssetInterface
 *
 * @package Scandinaver\Learn\Domain\Contract
 */
interface AssetInterface
{
    public function getType(): AssetType;

    /**
     * @return Collection<int, Card>
     */
    public function getCards(): Collection;

    public function addCard(Card $card): void;

    public function removeCard(Card $card): void;
}