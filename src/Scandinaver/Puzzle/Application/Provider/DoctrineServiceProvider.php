<?php


namespace Scandinaver\Puzzle\Application\Provider;


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