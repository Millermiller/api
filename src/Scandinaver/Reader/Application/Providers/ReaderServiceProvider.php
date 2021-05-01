<?php


namespace Scandinaver\Reader\Application\Providers;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;

/**
 * Class ReaderServiceProvider
 *
 * @package Scandinaver\Reader\Application\Providers
 */
class ReaderServiceProvider extends ServiceProvider
{
    public function register()
        {        $this->app->bind(
            ReaderInterface::class,
            'Scandinaver\Reader\Infrastructure\Service\AmazonReader'
        );
    }
}