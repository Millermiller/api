<?php

namespace Scandinaver\Statistic\Domain\Service;

use Scandinaver\Statistic\Domain\DTO\StatisticItemDTO;
use Scandinaver\Statistic\Domain\Entity\Item;

/**
 *
 */
class StatisticItemFactory
{

    public static function fromDTO(StatisticItemDTO $DTO): Item
    {
        return new Item(
            $DTO->getType(),
            $DTO->getUser(),
            $DTO->getValue(),
            $DTO->getData(),
        );
    }
}