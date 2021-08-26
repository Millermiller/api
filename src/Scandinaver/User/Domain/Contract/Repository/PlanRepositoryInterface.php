<?php


namespace Scandinaver\User\Domain\Contract\Repository;

use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\User\Domain\Entity\Plan;

/**
 * Interface PlanRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Plan>
 * @package Scandinaver\User\Domain\Contract
 */
interface PlanRepositoryInterface extends BaseRepositoryInterface
{

    public function findByName(string $name): Plan;
}