<?php


namespace Scandinaver\Billing\Domain\Service;


use Scandinaver\Billing\Domain\Contract\Repository\OrderRepositoryInterface;
use Scandinaver\Billing\Domain\DTO\OrderDTO;

/**
 * Class PaymentService
 *
 * @package Scandinaver\Billing\Domain\Service
 */
class PaymentService
{

    private OrderRepositoryInterface $orderRepository;

    private OrderFactory $orderFactory;

    public function __construct(OrderRepositoryInterface $orderRepository, OrderFactory $orderFactory)
    {
        $this->orderRepository = $orderRepository;
        $this->orderFactory    = $orderFactory;
    }



    public function register(OrderDTO $orderDTO): void
    {
        $order = $this->orderFactory->fromDTO($orderDTO);

        $this->orderRepository->save($order);
    }
}