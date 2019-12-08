<?php

namespace App\Repositories\Plan;

use App\Entities\Plan;
use App\Repositories\BaseRepositoryInterface;

interface PlanRepositoryInterface extends BaseRepositoryInterface
{
    public function findByName(string $name): Plan;
}