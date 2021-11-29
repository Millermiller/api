<?php


namespace Scandinaver\Learning\Puzzle\Application\Provider;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Learning\Puzzle\Domain\Contract\Repository\PuzzleRepositoryInterface;
use Scandinaver\Learning\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\Learning\Puzzle\Infrastructure\Persistence\Doctrine\Repository\PuzzleRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Puzzle\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            PuzzleRepositoryInterface::class,
            function () {
                return new PuzzleRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Puzzle::class)
                );
            }
        );
    }
}