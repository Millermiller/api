<?php


namespace Scandinaver\Common\Application\Provider;

use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;
use Scandinaver\Common\Domain\Contract\HashInterface;
use Scandinaver\Common\Domain\Contract\RedisInterface;

/**
 * Class CommonServiceProvider
 *
 * @package Scandinaver\Common\Application\Provider
 */
class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'EventBusInterface',
            'Scandinaver\Common\Infrastructure\Service\LaravelEventBus'
        );

        $this->app->bind(
            HashInterface::class,
            'Scandinaver\Common\Infrastructure\Service\LaravelHash'
        );

        $this->app->bind(
            RedisInterface::class,
            'Scandinaver\Common\Infrastructure\Service\LaravelRedis'
        );

        $this->app->bind(
            LoggerInterface::class,
            'Scandinaver\Common\Infrastructure\Service\Logger'
        );
    }
}