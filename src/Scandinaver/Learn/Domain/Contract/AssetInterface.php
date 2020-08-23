<?php


namespace Scandinaver\Learn\Domain\Contract;


use Doctrine\Common\Collections\Collection;
use Scandinaver\Learn\Domain\Model\Card;

interface AssetInterface
{
    public function getType(): string;

    public function getCards(): Collection;

    public function addCard(Card $card);

    public function removeCard(Card $card);
}