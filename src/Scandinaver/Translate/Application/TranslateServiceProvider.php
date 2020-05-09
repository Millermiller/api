<?php


namespace Scandinaver\Translate\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Translate\Domain\{Contracts\ResultRepositoryInterface, Contracts\TextRepositoryInterface, Result, Text};
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\{ResultRepository, TextRepository};

/**
 * Class TextServiceProvider
 *
 * @package Scandinaver\Translate\Application
 */
class TranslateServiceProvider extends ServiceProvider
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
            'Scandinaver\Translate\Application\Handlers\GetTextHandler'
        );

        $this->app->bind(
            'CompleteTextHandlerInterface',
            'Scandinaver\Translate\Application\Handlers\CompleteTextHandler'
        );
    }
}