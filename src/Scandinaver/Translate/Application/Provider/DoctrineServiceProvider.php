<?php


namespace Scandinaver\Translate\Application\Provider;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Translate\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Model\Result;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\ResultRepository;
use Scandinaver\Translate\Infrastructure\Persistence\Doctrine\TextRepository;

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
    }
}