<?php


namespace Scandinaver\Statistic\Domain\Contract;


use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;
use Scandinaver\Statistic\Domain\Entity\Item;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;

/**
 * Interface ItemRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Item>
 * @package Scandinaver\Statistic\Domain\Contract
 */
interface ItemRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

}