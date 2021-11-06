<?php


namespace Scandinaver\Billing\Domain\Service;

use Scandinaver\Billing\Domain\Contract\Repository\OrderRepositoryInterface;

/**
 * Class OrderService
 *
 * @package Scandinaver\Billing\Domain\Service
 */
class OrderService
{
    private OrderRepositoryInterface $orderRepository;


    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function all(): array
    {
        return $this->orderRepository->findAll();
    }
}