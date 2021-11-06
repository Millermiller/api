<?php


namespace Scandinaver\Learning\Asset\Application\Provider;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\ExampleRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\SentenceAssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\WordAssetRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Learning\Asset\Domain\Entity\Card;
use Scandinaver\Learning\Asset\Domain\Entity\Example;
use Scandinaver\Learning\Asset\Domain\Entity\FavouriteAsset;
use Scandinaver\Learning\Asset\Domain\Entity\Passing;
use Scandinaver\Learning\Asset\Domain\Entity\PersonalAsset;
use Scandinaver\Learning\Asset\Domain\Entity\SentenceAsset;
use Scandinaver\Learning\Asset\Domain\Entity\Term;
use Scandinaver\Learning\Asset\Domain\Entity\Translate;
use Scandinaver\Learning\Asset\Domain\Entity\WordAsset;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\AssetRepository;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\CardRepository;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\ExampleRepository;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\FavouriteAssetRepository;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\PassingRepository;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\PersonalAssetRepository;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\SentenceAssetRepository;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\TranslateRepository;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\WordAssetRepository;
use Scandinaver\Learning\Asset\Infrastructure\Persistence\Doctrine\Repository\TermRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Learn\Application\Provider
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
            TermRepositoryInterface::class,
            function () {
                return new TermRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Term::class)
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