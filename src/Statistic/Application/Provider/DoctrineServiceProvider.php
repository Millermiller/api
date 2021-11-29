<?php


namespace Scandinaver\Statistic\Application\Provider;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Statistic\Domain\Contract\ItemRepositoryInterface;
use Scandinaver\Statistic\Domain\Entity\Item;
use Scandinaver\Statistic\Infrastructure\Persistence\Doctrine\Repository\ItemRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Statistic\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            ItemRepositoryInterface::class,
            function () {
                return new ItemRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Item::class)
                );
            }
        );
    }
}