<?php


namespace Scandinaver\Puzzle\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Puzzle\Domain\Permissions\Puzzle;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Puzzle\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(Puzzle::VIEW, function (User $user) {
            return true;
        });

        Gate::define('view-puzzles-by-user', function (User $user) {
            return true;
        });

        Gate::define(Puzzle::SHOW, function (User $user, int $puzzleId) {
            return true;
        });

        Gate::define(Puzzle::CREATE, function (User $user) {
            return true;
        });

        Gate::define(Puzzle::UPDATE, function (User $user, int $puzzleId) {
            return true;
        });

        Gate::define(Puzzle::COMPLETE, function (User $user, int $puzzleId) {
            return true;
        });

        Gate::define(Puzzle::DELETE, function (User $user, int $puzzleId) {
            return true;
        });
    }
}