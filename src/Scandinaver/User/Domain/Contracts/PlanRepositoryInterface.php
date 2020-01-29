<?php


namespace Scandinaver\User\Domain\Contracts;

use Scandinaver\Shared\Contracts\BaseRepositoryInterface;
use Scandinaver\User\Domain\Plan;

/**
 * Interface PlanRepositoryInterface
 * @package Scandinaver\User\Domain\Contracts
 */
interface PlanRepositoryInterface extends BaseRepositoryInterface
{
    public function findByName(string $name): Plan;
}