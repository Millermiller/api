<?php


namespace Scandinaver\Learn\Application\Provider;


use Doctrine\ORM\EntityManager;
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
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Learn\Domain\Model\Example;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\Learn\Domain\Model\Passing;
use Scandinaver\Learn\Domain\Model\PersonalAsset;
use Scandinaver\Learn\Domain\Model\SentenceAsset;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Model\Word;
use Scandinaver\Learn\Domain\Model\WordAsset;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\AssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\CardRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\ExampleRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\FavouriteAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\PassingRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\PersonalAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\SentenceAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\TranslateRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\WordAssetRepository;
use Scandinaver\Learn\Infrastructure\Persistence\Doctrine\WordRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Learn\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{

    public function register()
    {
        /** @var EntityManager $em */
        $em = $this->app['em'];

        $this->app->bind(
            CardRepositoryInterface::class,
            fn() => new CardRepository($em, $em->getClassMetadata(Card::class))
        );

        $this->app->bind(
            TranslateRepositoryInterface::class,
            fn() => new TranslateRepository($em, $em->getClassMetadata(Translate::class))
        );

        $this->app->bind(
            WordRepositoryInterface::class,
            fn() => new WordRepository($em, $em->getClassMetadata(Word::class))
        );

        $this->app->bind(
            AssetRepositoryInterface::class,
            fn() => new AssetRepository($em, $em->getClassMetadata(Asset::class))
        );

        $this->app->bind(
            FavouriteAssetRepositoryInterface::class,
            fn() => new FavouriteAssetRepository($em,
                $em->getClassMetadata(FavouriteAsset::class))
        );

        $this->app->bind(WordAssetRepositoryInterface::class,
            fn() => new WordAssetRepository($em, $em->getClassMetadata(WordAsset::class))
        );

        $this->app->bind(
            SentenceAssetRepositoryInterface::class,
            fn() => new SentenceAssetRepository($em, $em->getClassMetadata(SentenceAsset::class))
        );

        $this->app->bind(
            PersonalAssetRepositoryInterface::class,
            fn() => new PersonalAssetRepository($em, $em->getClassMetadata(PersonalAsset::class))
        );

        $this->app->bind(
            PassingRepositoryInterface::class,
            fn() => new PassingRepository($em, $em->getClassMetadata(Passing::class))
        );

        $this->app->bind(
            ExampleRepositoryInterface::class,
            fn() => new ExampleRepository($em, $em->getClassMetadata(Example::class))
        );
    }
}