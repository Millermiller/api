<?php


namespace Scandinaver\Learn\Application\Providers;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ExampleRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\SentenceAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\Example;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\PersonalAsset;
use Scandinaver\Learn\Domain\Model\Passing;
use Scandinaver\Learn\Domain\Model\SentenceAsset;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\AssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\CardRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\ExampleRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\FavouriteAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\PersonalAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\PassingRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\SentenceAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\TranslateRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\WordAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\WordRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Learn\Application\Providers
 */
class DoctrineServiceProvider extends ServiceProvider
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
            PassingRepositoryInterface::class,
            function () {
                return new PassingRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Passing::class)
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
    }
}