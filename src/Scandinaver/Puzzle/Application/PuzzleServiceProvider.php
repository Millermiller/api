<?php


namespace Scandinaver\Puzzle\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Puzzle\Domain\Puzzle;
use Scandinaver\Puzzle\Domain\PuzzleRepositoryInterface;
use Scandinaver\Puzzle\Infrastructure\Doctrine\PuzzleRepository;

class PuzzleServiceProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PuzzleRepositoryInterface::class, function () {
            return new PuzzleRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Puzzle::class)
            );
        });
    }
}