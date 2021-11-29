<?php


namespace Scandinaver\Statistic\Domain\Service;

use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Statistic\Domain\Contract\ItemRepositoryInterface;
use Scandinaver\Statistic\Domain\Entity\Item;

/**
 * Class StatisticService
 *
 * @package Scandinaver\Statistic\Domain\Service
 */
class StatisticService
{

    public function __construct(
        private ItemRepositoryInterface $itemRepository
    ) {
    }

    public function create(string $type, UserInterface $user, ?int $value, ?array $data): Item
    {
        $item = new Item($type, $user, $value, $data);

        $this->itemRepository->save($item);
    }
}