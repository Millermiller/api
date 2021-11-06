<?php


namespace Scandinaver\Billing\Domain\Contract;

/**
 * Interface PaymentAggregatorInterface
 *
 * @package Scandinaver\Billing\Domain\Contract
 */
interface PaymentAggregatorInterface
{

    public function pay();
}