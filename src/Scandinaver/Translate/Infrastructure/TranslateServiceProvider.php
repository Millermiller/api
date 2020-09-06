<?php


namespace Scandinaver\Translate\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\{ResultRepository, TextRepository};
use Scandinaver\Translate\Application\Handler\Command\CompleteTextHandler;
use Scandinaver\Translate\Application\Handler\Command\CreateSynonymHandler;
use Scandinaver\Translate\Application\Handler\Command\CreateTextExtraHandler;
use Scandinaver\Translate\Application\Handler\Command\CreateTextHandler;
use Scandinaver\Translate\Application\Handler\Command\DeleteSynonymHandler;
use Scandinaver\Translate\Application\Handler\Command\DeleteTextHandler;
use Scandinaver\Translate\Application\Handler\Command\PublishTextHandler;
use Scandinaver\Translate\Application\Handler\Command\UnpublishTextHandler;
use Scandinaver\Translate\Application\Handler\Command\UpdateDescriptionHandler;
use Scandinaver\Translate\Application\Handler\Query\GetSynonymsHandler;
use Scandinaver\Translate\Application\Handler\Query\GetTextHandler;
use Scandinaver\Translate\Application\Handler\Query\GetTextsHandler;
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

        $this->app->bind('GetTextHandlerInterface', GetTextHandler::class);
        $this->app->bind('GetTextsHandlerInterface', GetTextsHandler::class);
        $this->app->bind('GetSynonymsHandlerInterface', GetSynonymsHandler::class);
        $this->app->bind('CompleteTextHandlerInterface', CompleteTextHandler::class);
        $this->app->bind('CreateSynonymHandlerInterface', CreateSynonymHandler::class);
        $this->app->bind('CreateTextHandlerInterface', CreateTextHandler::class);
        $this->app->bind('CreateTextExtraHandlerInterface', CreateTextExtraHandler::class);
        $this->app->bind('DeleteSynonymHandlerInterface', DeleteSynonymHandler::class);
        $this->app->bind('DeleteTextHandlerInterface', DeleteTextHandler::class);
        $this->app->bind('PublishTextHandlerInterface', PublishTextHandler::class);
        $this->app->bind('UnpublishTextHandlerInterface', UnpublishTextHandler::class);
        $this->app->bind('UpdateDescriptionHandlerInterface', UpdateDescriptionHandler::class);
    }
}