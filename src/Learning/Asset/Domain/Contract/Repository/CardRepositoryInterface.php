<?php


namespace Scandinaver\Learning\Asset\Domain\Contract\Repository;

use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Card;

/**
 * Interface CardRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Card>
 * @package Scandinaver\Learn\Domain\Contract\Repository
 */
interface CardRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

}