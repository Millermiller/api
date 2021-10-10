<?php


namespace Scandinaver\Billing\Domain\Contract\Repository;

use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Billing\Domain\Entity\Plan;

/**
 * Interface PlanRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Plan>
 * @package Scandinaver\Billing\Domain\Contract
 */
interface PlanRepositoryInterface extends BaseRepositoryInterface
{

    public function findByName(string $name): Plan;
}