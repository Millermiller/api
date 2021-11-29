<?php


namespace Scandinaver\Billing\UI\Resource;


use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\TransformerAbstract;
use Scandinaver\Billing\Domain\Entity\Plan;

/**
 * Class PlanTransformer
 *
 * @package Scandinaver\Billing\UI\Resource
 */
class PlanTransformer extends TransformerAbstract
{

    #[ArrayShape([
        'id'       => "\Ramsey\Uuid\UuidInterface",
        'title'    => "null|string",
        'duration' => "string",
    ])]
    public function transform(Plan $plan): array
    {
        return [
            'id'       => $plan->getId(),
            'title'    => $plan->getName(),
            'duration' => $plan->getDuration()->format('%m month'),
        ];
    }
}