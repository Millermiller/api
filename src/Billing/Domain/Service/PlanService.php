<?php


namespace Scandinaver\Billing\Domain\Service;

use Scandinaver\Billing\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\Billing\Domain\Entity\Plan;

/**
 * Class PlanService
 *
 * @package Scandinaver\Billing\Domain\Service
 */
class PlanService
{

    private PlanRepositoryInterface $planRepository;

    public function __construct(PlanRepositoryInterface $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function all(): array
    {
        // $plan = new Plan();
        // $plan->setName('test');
        // $plan->setPeriod(new \DateInterval('P2M'));
        // $plan->setCost(100);
        // $plan->setCostPerMonth(100);
        // $this->planRepository->save($plan);

        return $this->planRepository->findAll();
    }
}