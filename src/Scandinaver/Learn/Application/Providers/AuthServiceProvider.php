<?php


namespace Scandinaver\Learn\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Learn\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /* ASSET */
        Gate::define('view-assets', function (User $user) {
            return true;
        });

        Gate::define('create-asset', function (User $user) {
            return true;
        });

        Gate::define('update-asset', function (User $user, $id) {
            return true;
        });

        Gate::define('delete-asset', function (User $user, $id) {
            return true;
        });

        /* FAVOURITE */
        Gate::define('create-favourite', function (User $user, $id) {
            return true;
        });

        Gate::define('delete-favourite', function (User $user, $id) {
            return true;
        });
    }
}