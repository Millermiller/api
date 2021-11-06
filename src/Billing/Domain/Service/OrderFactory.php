<?php


namespace Scandinaver\Billing\Domain\Service;


use Scandinaver\Billing\Domain\DTO\OrderDTO;
use Scandinaver\Billing\Domain\Entity\Order;

/**
 * Class OrderFactory
 *
 * @package Scandinaver\Billing\Domain\Service
 */
class OrderFactory
{

    public function fromDTO(OrderDTO $orderDTO): Order
    {
        $order = new Order();
        $order->setSum($orderDTO->getSum());

        return $order;
    }
}