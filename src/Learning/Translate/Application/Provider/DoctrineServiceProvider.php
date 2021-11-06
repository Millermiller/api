<?php


namespace Scandinaver\Learning\Translate\Application\Provider;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Shared\BaseRepository;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\SynonymRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\TooltipRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learning\Translate\Domain\Entity\Passing;
use Scandinaver\Learning\Translate\Domain\Entity\Synonym;
use Scandinaver\Learning\Translate\Domain\Entity\Text;
use Scandinaver\Learning\Translate\Domain\Entity\Tooltip;
use Scandinaver\Learning\Translate\Domain\Entity\DictionaryItem;
use Scandinaver\Learning\Translate\Infrastructure\Persistence\Doctrine\Repository\SynonymRepository;
use Scandinaver\Learning\Translate\Infrastructure\Persistence\Doctrine\Repository\TooltipRepository;
use Scandinaver\Learning\Translate\Infrastructure\Persistence\Doctrine\Repository\WordRepository;
use Scandinaver\Learning\Translate\Domain\Service\{TextService, SynonymFactory};
use Scandinaver\Learning\Translate\Infrastructure\Persistence\Doctrine\Repository\ResultRepository;
use Scandinaver\Learning\Translate\Infrastructure\Persistence\Doctrine\Repository\TextRepository;

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