<?php


namespace Scandinaver\Billing\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Billing\Domain\Service\OrderService;
use Scandinaver\Billing\UI\Resource\OrderTransformer;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Billing\UI\Query\GetOrdersQuery;

/**
 * Class GetOrdersQueryHandler
 *
 * @package Scandinaver\Billing\Application\Handler\Query
 */
class GetOrdersQueryHandler extends AbstractHandler
{

    private OrderService $service;

    public function __construct(OrderService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param GetOrdersQuery|CommandInterface $query
     */
    public function handle($query): void
    {
        $orders = $this->service->all();

        $this->resource = new Collection($orders, new OrderTransformer());
    }
} 