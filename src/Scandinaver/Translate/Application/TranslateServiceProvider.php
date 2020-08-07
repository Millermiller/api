<?php


namespace Scandinaver\Translate\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\{ResultRepository, TextRepository};
use Scandinaver\Translate\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Model\Result;
use Scandinaver\Translate\Domain\Model\Text;

/**
 * Class TextServiceProvider
 *
 * @package Scandinaver\Translate\Application
 */
class TranslateServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TextRepositoryInterface::class,
            function () {
                return new TextRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Text::class)
                );
            }
        );

        $this->app->bind(
            ResultRepositoryInterface::class,
            function () {
                return new ResultRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Result::class)
                );
            }
        );

        $this->app->bind(
            'GetTextHandlerInterface',
            'Scandinaver\Translate\Application\Handler\Query\GetTextHandler'
        );

        $this->app->bind(
            'CompleteTextHandlerInterface',
            'Scandinaver\Translate\Application\Handler\Command\CompleteTextHandler'
        );
    }
}