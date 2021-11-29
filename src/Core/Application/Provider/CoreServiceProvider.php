<?php


namespace Scandinaver\Core\Application\Provider;

use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;
use Scandinaver\Core\Domain\Contract\DispatcherInterface;
use Scandinaver\Core\Domain\Contract\EventBusInterface;
use Scandinaver\Core\Domain\Contract\HashInterface;
use Scandinaver\Core\Domain\Contract\RedisInterface;

/**
 * Class CommonServiceProvider
 *
 * @package Scandinaver\Common\Application\Provider
 */
class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'EventBusInterface',
            'Scandinaver\Core\Infrastructure\Service\LaravelEventBus'
        );

        $this->app->bind(
            HashInterface::class,
            'Scandinaver\Common\Infrastructure\Service\LaravelHash'
        );

        $this->app->bind(
            RedisInterface::class,
            'Scandinaver\Core\Infrastructure\Service\LaravelRedis'
        );

        $this->app->bind(
            LoggerInterface::class,
            'Scandinaver\Core\Infrastructure\Service\Logger'
        );

        $this->app->bind(
            DispatcherInterface::class,
            'Scandinaver\Core\Infrastructure\Service\Dispatcher'
        );
    }
}