<?php


namespace Scandinaver\Learn\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Learn\Domain\{Result, Translate, Word, Card, Asset};
use Scandinaver\Learn\Domain\Contracts\{AssetRepositoryInterface,
    CardRepositoryInterface,
    ResultRepositoryInterface,
    TranslateRepositoryInterface,
    WordRepositoryInterface};
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\{AssetRepository,
    CardRepository,
    TranslateRepository,
    WordRepository,
    ResultRepository};

/**
 * Class TextServiceProvider
 * @package Scandinaver\Text\Application
 */
class LearnServiceProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CardRepositoryInterface::class, function () {
            return new CardRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Card::class)
            );
        });

        $this->app->bind(TranslateRepositoryInterface::class, function () {
            return new TranslateRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Translate::class)
            );
        });

        $this->app->bind(WordRepositoryInterface::class, function () {
            return new WordRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Word::class)
            );
        });

        $this->app->bind(AssetRepositoryInterface::class, function () {
            return new AssetRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Asset::class)
            );
        });

        $this->app->bind(ResultRepositoryInterface::class, function () {
            return new ResultRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Result::class)
            );
        });

        $this->app->bind(
            'CreateFavouriteHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\CreateFavouriteHandler'
        );

        $this->app->bind(
            'DeleteFavouriteHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\DeleteFavouriteHandler'
        );

        $this->app->bind(
            'CreateAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\CreateAssetHandler'
        );

        $this->app->bind(
            'DeleteAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\DeleteAssetHandler'
        );

        $this->app->bind(
            'UpdateAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\UpdateAssetHandler'
        );

        $this->app->bind(
            'CardsOfAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\CardsOfAssetHandler'
        );

        $this->app->bind(
            'DeleteCardFromAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\DeleteCardFromAssetHandler'
        );

        $this->app->bind(
            'AddCardToAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\AddCardToAssetHandler'
        );

        $this->app->bind(
            'SaveTestResultHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\SaveTestResultHandler'
        );

        $this->app->bind(
            'GiveNextLevelHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\GiveNextLevelHandler'
        );
    }
}