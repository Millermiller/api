<?php


namespace Scandinaver\Translate\Application\Provider;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\SynonymRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextExtraRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Translate\Domain\Entity\Result;
use Scandinaver\Translate\Domain\Entity\Synonym;
use Scandinaver\Translate\Domain\Entity\Text;
use Scandinaver\Translate\Domain\Entity\TextExtra;
use Scandinaver\Translate\Domain\Entity\Word;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository\SynonymRepository;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository\TextExtraRepository;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository\WordRepository;
use Scandinaver\Translate\Domain\Service\{TextService, SynonymFactory};
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository\ResultRepository;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository\TextRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Translate\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
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
            SynonymRepositoryInterface::class,
            function () {
                return new SynonymRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Synonym::class)
                );
            }
        );

        $this->app->bind(
            TextExtraRepositoryInterface::class,
            function () {
                return new TextExtraRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(TextExtra::class)
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

        $this->app
            ->when(SynonymFactory::class)
            ->needs(BaseRepositoryInterface::class)
            ->give(function(){
                return new BaseRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Word::class)
                );
            });
    }
}