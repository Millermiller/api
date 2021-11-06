<?php


namespace Scandinaver\Billing\UI\Resource;


use League\Fractal\TransformerAbstract;
use Scandinaver\Billing\Domain\Entity\Payment;
use Scandinaver\Billing\Domain\Entity\Service;

/**
 * Class ServiceTransformer
 *
 * @package Scandinaver\Billing\UI\Resource
 */
class ServiceTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [

    ];

    public function transform(Service $service): array
    {
        return [
            'id'   => $service->getId(),
            'type' => $service->getType()
        ];
    }
}