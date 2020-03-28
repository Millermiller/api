<?php


namespace Scandinaver\Learn\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Learn\Domain\{Asset, Card, Result, Translate, Word};
use Scandinaver\Learn\Domain\Contracts\{AssetRepositoryInterface,
    CardRepositoryInterface,
    ResultRepositoryInterface,
    TranslateRepositoryInterface,
    WordRepositoryInterface};
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\{AssetRepository,
    CardRepository,
    ResultRepository,
    TranslateRepository,
    WordRepository};

/**
 * Class TextServiceProvider
 *
 * @package Scandinaver\Text\Application
 */
class LearnServiceProvider extends ServiceProvider
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

        $this->app->bind(
            'AssetForUserByTypeHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\AssetForUserByTypeHandler'
        );

        $this->app->bind(
            'PersonalAssetsHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\PersonalAssetsHandler'
        );

        $this->app->bind(
            'WordsCountHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\WordsCountHandler'
        );

        $this->app->bind(
            'TextsCountHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\TextsCountHandler'
        );

        $this->app->bind(
            'AudioCountHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\AudioCountHandler'
        );

        $this->app->bind(
            'AssetsCountHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\AssetsCountHandler'
        );

        $this->app->bind(
            'FindAudioHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\FindAudioHandler'
        );

        $this->app->bind(
            'AudioParserInterface',
            'Scandinaver\Learn\Infrastructure\ForvoParser'
        );

        $this->app->bind(
            'GetTranslatesByWordHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\GetTranslatesByWordHandler'
        );

        $this->app->bind(
            'GetExamplesForCardHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\GetExamplesForCardHandler'
        );

        $this->app->bind(
            'SetTranslateForCardHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\SetTranslateForCardHandler'
        );

        $this->app->bind(
            'EditTranslateHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\EditTranslateHandler'
        );

        $this->app->bind(
            'CreateTranslateHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\CreateTranslateHandler'
        );

        $this->app->bind(
            'UploadAudioHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\UploadAudioHandler'
        );

        $this->app->bind(
            'GetUnusedSentencesHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\GetUnusedSentencesHandler'
        );

        $this->app->bind(
            'AddBasicLevelHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\AddBasicLevelHandler'
        );

        $this->app->bind(
            'AddWordAndTranslateHandlerInterface',
            'Scandinaver\Learn\Application\Handlers\AddWordAndTranslateHandler'
        );
    }
}