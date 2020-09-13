<?php


namespace Scandinaver\Learn\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Learn\Domain\Model\{Asset,
    Card,
    Example,
    FavouriteAsset,
    PersonalAsset,
    Result,
    SentenceAsset,
    Translate,
    Word,
    WordAsset};
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\{AssetRepository,
    CardRepository,
    ExampleRepository,
    FavouriteAssetRepository,
    PersonalAssetRepository,
    ResultRepository,
    SentenceAssetRepository,
    TranslateRepository,
    WordAssetRepository,
    WordRepository};
use Scandinaver\Learn\Application\Handler\Command\UpdateCardHandler;
use Scandinaver\Learn\Domain\Contract\AudioParserInterface;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ExampleRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\SentenceAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;

/**
 * Class LearnServiceProvider
 *
 * @package Scandinaver\Learn\Application
 */
class LearnServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CardRepositoryInterface::class,
            function () {
                return new CardRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Card::class)
                );
            }
        );

        $this->app->bind(
            TranslateRepositoryInterface::class,
            function () {
                return new TranslateRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Translate::class)
                );
            }
        );

        $this->app->bind(
            WordRepositoryInterface::class,
            function () {
                return new WordRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Word::class)
                );
            }
        );

        $this->app->bind(
            AssetRepositoryInterface::class,
            function () {
                return new AssetRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Asset::class)
                );
            }
        );

        $this->app->bind(
            FavouriteAssetRepositoryInterface::class,
            function () {
                return new FavouriteAssetRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(FavouriteAsset::class)
                );
            }
        );

        $this->app->bind(
            WordAssetRepositoryInterface::class,
            function () {
                return new WordAssetRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(WordAsset::class)
                );
            }
        );

        $this->app->bind(
            SentenceAssetRepositoryInterface::class,
            function () {
                return new SentenceAssetRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(SentenceAsset::class)
                );
            }
        );

        $this->app->bind(
            PersonalAssetRepositoryInterface::class,
            function () {
                return new PersonalAssetRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(PersonalAsset::class)
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
            ExampleRepositoryInterface::class,
            function () {
                return new ExampleRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Example::class)
                );
            }
        );

        $this->app->bind(
            'CreateFavouriteHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\CreateFavouriteHandler'
        );

        $this->app->bind(
            'DeleteFavouriteHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\DeleteFavouriteHandler'
        );

        $this->app->bind(
            'CreateAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\CreateAssetHandler'
        );

        $this->app->bind(
            'DeleteAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\DeleteAssetHandler'
        );

        $this->app->bind(
            'UpdateAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\UpdateAssetHandler'
        );

        $this->app->bind(
            'CardsOfAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\CardsOfAssetHandler'
        );

        $this->app->bind(
            'DeleteCardFromAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\DeleteCardFromAssetHandler'
        );

        $this->app->bind(
            'AddCardToAssetHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\AddCardToAssetHandler'
        );

        $this->app->bind(
            'SaveTestResultHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\SaveTestResultHandler'
        );

        $this->app->bind(
            'GiveNextLevelHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\GiveNextLevelHandler'
        );

        $this->app->bind(
            'AssetForUserByTypeHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\AssetForUserByTypeHandler'
        );

        $this->app->bind(
            'PersonalAssetsHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\PersonalAssetsHandler'
        );

        $this->app->bind(
            'WordsCountHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\WordsCountHandler'
        );

        $this->app->bind(
            'TextsCountHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\TextsCountHandler'
        );

        $this->app->bind(
            'AudioCountHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\AudioCountHandler'
        );

        $this->app->bind(
            'AssetsCountHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\AssetsCountHandler'
        );

        $this->app->bind(
            'FindAudioHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\FindAudioHandler'
        );

        $this->app->bind(
            AudioParserInterface::class,
            'Scandinaver\Learn\Infrastructure\ForvoParser'
        );

        $this->app->bind(
            'GetTranslatesByWordHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\GetTranslatesByWordHandler'
        );

        $this->app->bind(
            'GetExamplesForCardHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\GetExamplesForCardHandler'
        );

        $this->app->bind(
            'SetTranslateForCardHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\SetTranslateForCardHandler'
        );

        $this->app->bind(
            'EditTranslateHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\EditTranslateHandler'
        );

        $this->app->bind(
            'CreateTranslateHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\CreateTranslateHandler'
        );

        $this->app->bind(
            'UploadAudioHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\UploadAudioHandler'
        );

        $this->app->bind(
            'GetUnusedSentencesHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\GetUnusedSentencesHandler'
        );

        $this->app->bind(
            'AddBasicLevelHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\AddBasicLevelHandler'
        );

        $this->app->bind(
            'AddWordAndTranslateHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Command\AddWordAndTranslateHandler'
        );

        $this->app->bind(
            'AssetsCountByLanguageHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\AssetsCountByLanguageHandler'
        );

        $this->app->bind(
            'WordsCountByLanguageHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\WordsCountByLanguageHandler'
        );

        $this->app->bind(
            'TextsCountByLanguageHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\TextsCountByLanguageHandler'
        );

        $this->app->bind(
            'AudioCountByLanguageHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\AudioCountByLanguageHandler'
        );

        $this->app->bind(
            'GetAssetsByTypeHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\GetAssetsByTypeHandler'
        );

        $this->app->bind(
            'AssetsHandlerInterface',
            'Scandinaver\Learn\Application\Handler\Query\AssetsHandler'
        );

        $this->app->bind(
            'UpdateCardHandlerInterface', UpdateCardHandler::class
        );
    }
}