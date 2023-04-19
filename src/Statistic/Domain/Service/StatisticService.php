<?php


namespace Scandinaver\Statistic\Domain\Service;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Infrastructure\RequestParametersComposition;
use Scandinaver\Statistic\Domain\Contract\ItemRepositoryInterface;
use Scandinaver\Statistic\Domain\DTO\StatisticItemDTO;
use Scandinaver\Statistic\Domain\Entity\Item;

/**
 * Class StatisticService
 *
 * @package Scandinaver\Statistic\Domain\Service
 */
class StatisticService
{

    public function __construct(
        private readonly ItemRepositoryInterface $itemRepository
    ) {
    }

    public function create(StatisticItemDTO $dto): Item
    {
        $item = StatisticItemFactory::fromDTO($dto);

        $this->itemRepository->save($item);

        return $item;
    }

    public function paginate(RequestParametersComposition $params): LengthAwarePaginator
    {
        return $this->itemRepository->getData($params);
    }
}