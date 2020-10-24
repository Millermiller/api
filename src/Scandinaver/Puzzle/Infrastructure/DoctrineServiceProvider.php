<?php


namespace Scandinaver\Puzzle\Infrastructure;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Puzzle\Domain\Contract\Repository\PuzzleRepositoryInterface;
use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Puzzle\Infrastructure\Persistence\Doctrine\PuzzleRepository;

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