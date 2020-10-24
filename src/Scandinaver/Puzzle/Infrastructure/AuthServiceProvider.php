<?php


namespace Scandinaver\Puzzle\Infrastructure;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\User\Domain\Model\User;


class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('view-puzzles', function (User $user) {
            return true;
        });

        Gate::define('view-puzzles-by-user', function (User $user) {
            return true;
        });

        Gate::define('show-puzzle', function (User $user, int $puzzleId) {
            return true;
        });

        Gate::define('create-puzzle', function (User $user) {
            return true;
        });

        Gate::define('update-puzzle', function (User $user, int $puzzleId) {
            return true;
        });

        Gate::define('complete-puzzle', function (User $user, int $puzzleId) {
            return true;
        });

        Gate::define('delete-puzzle', function (User $user, int $puzzleId) {
            return true;
        });
    }
}