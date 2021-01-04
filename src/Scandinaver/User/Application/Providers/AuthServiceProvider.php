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
        Gate::define(\Scandinaver\User\Domain\Permissions\User::VIEW, function (User $user) {
            return true;
        });

        Gate::define(\Scandinaver\User\Domain\Permissions\User::SHOW, function (User $user, int $userId) {
            return true;
        });

        Gate::define(\Scandinaver\User\Domain\Permissions\User::CREATE, function (User $user) {
            return true;
        });

        Gate::define(\Scandinaver\User\Domain\Permissions\User::UPDATE, function (User $user, int $userId) {
            return true;
        });

        Gate::define(\Scandinaver\User\Domain\Permissions\User::DELETE, function (User $user, int $userId) {
            return true;
        });
    }
}