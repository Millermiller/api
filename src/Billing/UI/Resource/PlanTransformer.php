<?php


namespace Scandinaver\Billing\UI\Resource;


use League\Fractal\TransformerAbstract;
use Scandinaver\Billing\Domain\Entity\Plan;

/**
 * Class PlanTransformer
 *
 * @package Scandinaver\Billing\UI\Resource
 */
class PlanTransformer extends TransformerAbstract
{

    public function transform(Plan $plan): array
    {
        return [
            'id' => $plan->getId(),
            'title' => $plan->getName(),
            'duration' => $plan->getDuration()->format('%m month')
        ];
    }
}