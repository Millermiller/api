<?php


namespace Scandinaver\Learn\Domain\Contract;


use Doctrine\Common\Collections\Collection;
use Scandinaver\Learn\Domain\Entity\Card;

/**
 * Interface AssetInterface
 *
 * @package Scandinaver\Learn\Domain\Contract
 */
interface AssetInterface
{
    public function getType(): int;

    public function getCards(): Collection;

    /**
     * @param  Card  $card
     *
     * @return mixed
     */
    public function addCard(Card $card);

    /**
     * @param  Card  $card
     *
     * @return mixed
     */
    public function removeCard(Card $card);
}