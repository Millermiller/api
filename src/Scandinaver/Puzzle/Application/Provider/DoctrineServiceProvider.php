<?php


namespace Scandinaver\Puzzle\Application\Provider;


use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;
use Scandinaver\Puzzle\Domain\Contract\Repository\PuzzleRepositoryInterface;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Puzzle\Infrastructure\Persistence\Doctrine\PuzzleRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Puzzle\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{

    public function register()
    {
        /** @var EntityManager $em */
        $em = $this->app['em'];

        $this->app->bind(PuzzleRepositoryInterface::class,
            fn() => new PuzzleRepository($em, $em->getClassMetadata(Puzzle::class))
        );
    }
}