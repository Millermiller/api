<?php


namespace Scandinaver\Billing\Infrastructure\Service;


use Scandinaver\Billing\Domain\Contract\PaymentAggregatorInterface;

/**
 * Class DummyPaymentAggregator
 *
 * @package Scandinaver\Billing\Infrastructure\Service
 */
class DummyPaymentAggregator implements PaymentAggregatorInterface
{

    public function pay()
    {
        // TODO: Implement pay() method.
    }
}