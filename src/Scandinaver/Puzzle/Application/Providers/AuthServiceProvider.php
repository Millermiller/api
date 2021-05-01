<?php


namespace Scandinaver\Puzzle\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Puzzle\Domain\Permissions\Puzzle;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Puzzle\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(Puzzle::VIEW, function (UserInterface $user) {
            return TRUE;
        });

        Gate::define('view-puzzles-by-user', function (UserInterface $user) {
            return TRUE;
        });

        Gate::define(Puzzle::SHOW, function (UserInterface $user, int $puzzleId) {
            return TRUE;
        });

        Gate::define(Puzzle::CREATE, function (UserInterface $user) {
            return TRUE;
        });

        Gate::define(Puzzle::UPDATE, function (UserInterface $user, int $puzzleId) {
            return TRUE;
        });

        Gate::define(Puzzle::COMPLETE, function (UserInterface $user, int $puzzleId) {
            return TRUE;
        });

        Gate::define(Puzzle::DELETE, function (UserInterface $user, int $puzzleId) {
            return TRUE;
        });
    }
}