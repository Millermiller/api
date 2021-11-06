<?php


namespace Scandinaver\Billing\Domain\Service;


use Scandinaver\Billing\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\Billing\Domain\Entity\Order;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;


/**
 * Class ProcessOrderService
 *
 * @package Scandinaver\Billing\Domain\Service
 */
class ProcessOrderService
{

    private RoleRepositoryInterface $roleRepository;

    private PlanRepositoryInterface $planRepository;

    public function __construct(RoleRepositoryInterface $roleRepository, PlanRepositoryInterface $planRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->planRepository = $planRepository;
    }

    public function process(Order $order): void
    {
        $service = $order->getService();

        if ($service->getType()->toNative() === 'PLAN') {
            $user = $order->getUser();

            $planId = $service->getItemId();
            $plan = $this->planRepository->find($planId);

            $duration = $plan->getDuration();
            $currentRaisedTo = $user->getRaisedTo();

            $newRaisedTo = $currentRaisedTo->add($duration);

            $user->setRaisedTo($newRaisedTo);
        }

        if ($service->getType()->toNative() === 'SINGLE') {
            //
        }
    }
}