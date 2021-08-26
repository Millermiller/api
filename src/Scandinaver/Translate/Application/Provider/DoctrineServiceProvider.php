<?php


namespace Scandinaver\Translate\Application\Provider;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\SynonymRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TooltipRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Translate\Domain\Entity\Passing;
use Scandinaver\Translate\Domain\Entity\Synonym;
use Scandinaver\Translate\Domain\Entity\Text;
use Scandinaver\Translate\Domain\Entity\Tooltip;
use Scandinaver\Translate\Domain\Entity\DictionaryItem;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository\SynonymRepository;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\Repository\TooltipRepository;
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
                    $this->app['em']->getClassMetadata(Passing::class)
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
            TooltipRepositoryInterface::class,
            function () {
                return new TooltipRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Tooltip::class)
                );
            }
        );

        $this->app->bind(
            WordRepositoryInterface::class,
            function () {
                return new WordRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(DictionaryItem::class)
                );
            }
        );

        $this->app
            ->when(SynonymFactory::class)
            ->needs(BaseRepositoryInterface::class)
            ->give(function(){
                return new BaseRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(DictionaryItem::class)
                );
            });
    }
}