<?php


namespace Scandinaver\Billing\UI\Resource;


use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\TransformerAbstract;
use Scandinaver\Billing\Domain\Entity\Payment;

/**
 * Class PaymentTransformer
 *
 * @package Scandinaver\Billing\UI\Resource
 */
class PaymentTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [

    ];

    #[ArrayShape([
        'id'         => "\Ramsey\Uuid\UuidInterface",
        'amount'     => "\Ramsey\Uuid\UuidInterface",
        'data'       => "array",
        'created_at' => "string",
    ])]
    public function transform(Payment $payment): array
    {
        return [
            'id'         => $payment->getId(),
            'amount'     => $payment->getId(),
            'data'       => $payment->getData(),
            'created_at' => $payment->getCreatedAt()->format("Y-m-d H:i:s"),
        ];
    }
}