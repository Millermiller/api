<?php


namespace Scandinaver\Reader\Infrastructure;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;

/**
 * Class CustomServiceProvider
 *
 * @package Scandinaver\Reader\Infrastructure
 */
class CustomServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ReaderInterface::class,
            'Scandinaver\Reader\Infrastructure\Service\AmazonReader'
        );
    }
}