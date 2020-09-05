<?php


namespace Scandinaver\Reader\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;

/**
 * Class ReaderServiceProvider
 *
 * @package Scandinaver\Reader\Infrastructure
 */
class ReaderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ReaderInterface::class,
            'Scandinaver\Reader\Infrastructure\AmazonReader'
        );

        $this->app->bind(
            'ReadHandlerInterface',
            'Scandinaver\Reader\Application\Handler\Query\ReadHandler'
        );
    }
}