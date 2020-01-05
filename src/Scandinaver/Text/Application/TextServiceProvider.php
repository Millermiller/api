<?php


namespace Scandinaver\Text\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Text\Domain\{Result, ResultRepositoryInterface, TextRepositoryInterface, Text};
use Scandinaver\Text\Infrastructure\Doctrine\ResultRepository;
use Scandinaver\Text\Infrastructure\Doctrine\TextRepository;

/**
 * Class TextServiceProvider
 * @package Scandinaver\Text\Application
 */
class TextServiceProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(TextRepositoryInterface::class, function () {
            return new TextRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Text::class)
            );
        });

        $this->app->bind(ResultRepositoryInterface::class, function () {
            return new ResultRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Result::class)
            );
        });
    }
}