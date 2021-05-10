<?php


namespace Scandinaver\Translate\Application\Provider;

use Doctrine\ORM\EntityManager;
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
        /** @var EntityManager $em */
        $em = $this->app['em'];

        $this->app->bind(
            TextRepositoryInterface::class,
            fn() => new TextRepository($em, $em->getClassMetadata(Text::class))
        );

        $this->app->bind(
            ResultRepositoryInterface::class,
            fn() => new ResultRepository($em, $em->getClassMetadata(Result::class))
        );
    }
}