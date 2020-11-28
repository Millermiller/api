<?php


namespace Scandinaver\User\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\User\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('view-users', function (User $user) {
            return true;
        });

        Gate::define('show-user', function (User $user, int $userId) {
            return true;
        });

        Gate::define('create-user', function (User $user) {
            return true;
        });

        Gate::define('update-user', function (User $user, int $userId) {
            return true;
        });

        Gate::define('delete-user', function (User $user, int $userId) {
            return true;
        });
    }
}