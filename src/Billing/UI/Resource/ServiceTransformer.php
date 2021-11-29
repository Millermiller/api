<?php


namespace Scandinaver\Billing\UI\Resource;


use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\TransformerAbstract;
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

    #[Pure]
    #[ArrayShape([
        'id'   => "\Ramsey\Uuid\UuidInterface",
        'type' => "\Scandinaver\Billing\Domain\Entity\ServiceType",
    ])]
    public function transform(Service $service): array
    {
        return [
            'id'   => $service->getId(),
            'type' => $service->getType(),
        ];
    }
}