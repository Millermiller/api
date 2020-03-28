<?php


namespace Scandinaver\Puzzle\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\Puzzle\Domain\{Contracts\PuzzleRepositoryInterface, Puzzle};
use Scandinaver\Puzzle\Infrastructure\Persistence\Doctrine\PuzzleRepository;

/**
 * Class PuzzleServiceProvider
 *
 * @package Scandinaver\Puzzle\Application
 */
class PuzzleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PuzzleRepositoryInterface::class, function () {
            return new PuzzleRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Puzzle::class)
            );
        });

        $this->app->bind(
            'PuzzleCompleteHandlerInterface',
            'Scandinaver\Puzzle\Application\Handlers\PuzzleCompletedHandler'
        );

        $this->app->bind(
            'UserPuzzlesHandlerInterface',
            'Scandinaver\Puzzle\Application\Handlers\UserPuzzlesHandler'
        );
    }
}