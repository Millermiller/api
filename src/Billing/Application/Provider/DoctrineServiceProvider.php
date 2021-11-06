<?php


namespace Scandinaver\Billing\Application\Provider;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Billing\Domain\Contract\Repository\OrderRepositoryInterface;
use Scandinaver\Billing\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\Billing\Domain\Entity\Order;
use Scandinaver\Billing\Domain\Entity\Plan;
use Scandinaver\Billing\Infrastructure\Persistence\Doctrine\Repository\OrderRepository;
use Scandinaver\Billing\Infrastructure\Persistence\Doctrine\Repository\PlanRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Billing\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            OrderRepositoryInterface::class,
            function () {
                return new OrderRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Order::class)
                );
            }
        );

        $this->app->bind(
            PlanRepositoryInterface::class,
            function () {
                return new PlanRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Plan::class)
                );
            }
        );
    }
}