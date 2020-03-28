<?php


namespace Scandinaver\Text\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Text\Domain\{Contracts\ResultRepositoryInterface, Contracts\TextRepositoryInterface, Result, Text};
use Scandinaver\Text\Infrastructure\Persistence\Doctrine\{ResultRepository, TextRepository};

/**
 * Class TextServiceProvider
 *
 * @package Scandinaver\Text\Application
 */
class TextServiceProvider extends ServiceProvider
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

        $this->app->bind(
            'GetTextHandlerInterface',
            'Scandinaver\Text\Application\Handlers\GetTextHandler'
        );

        $this->app->bind(
            'CompleteTextHandlerInterface',
            'Scandinaver\Text\Application\Handlers\CompleteTextHandler'
        );
    }
}