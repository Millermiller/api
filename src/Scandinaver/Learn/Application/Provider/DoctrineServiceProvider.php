<?php


namespace Scandinaver\Learn\Application\Provider;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Learn\Domain\Contract\Repository\AssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\ExampleRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\FavouriteAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\PersonalAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\SentenceAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\WordAssetRepositoryInterface;
use Scandinaver\Learn\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learn\Domain\Entity\Asset;
use Scandinaver\Learn\Domain\Entity\Card;
use Scandinaver\Learn\Domain\Entity\Example;
use Scandinaver\Learn\Domain\Entity\FavouriteAsset;
use Scandinaver\Learn\Domain\Entity\Passing;
use Scandinaver\Learn\Domain\Entity\PersonalAsset;
use Scandinaver\Learn\Domain\Entity\SentenceAsset;
use Scandinaver\Learn\Domain\Entity\Term;
use Scandinaver\Learn\Domain\Entity\Translate;
use Scandinaver\Learn\Domain\Entity\WordAsset;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\AssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\CardRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\ExampleRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\FavouriteAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\PassingRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\PersonalAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\SentenceAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\TranslateRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\WordAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\Repository\TermRepository;

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