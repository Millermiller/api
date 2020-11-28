<?php


namespace Scandinaver\RBAC\Application\Providers;

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
        Gate::define('view-roles', function (User $user) {
            return true;
        });

        Gate::define('show-role', function (User $user, int $userId) {
            return true;
        });

        Gate::define('create-role', function (User $user) {
            return true;
        });

        Gate::define('update-role', function (User $user, int $userId) {
            return true;
        });

        Gate::define('delete-role', function (User $user, int $userId) {
            return true;
        });

        Gate::define('view-permissions', function (User $user) {
            return true;
        });

        Gate::define('show-permission', function (User $user, int $userId) {
            return true;
        });

        Gate::define('create-permission', function (User $user) {
            return true;
        });

        Gate::define('update-permission', function (User $user, int $userId) {
            return true;
        });

        Gate::define('delete-permission', function (User $user, int $userId) {
            return true;
        });
    }
}