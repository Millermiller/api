<?php


namespace Scandinaver\Common\Infrastructure;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\User\Domain\Model\User;


class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /* INTRO */
        Gate::define('view-intros', function (User $user) {
            return true;
        });

        Gate::define('show-intro', function (User $user, $id) {
            return true;
        });

        Gate::define('create-intro', function (User $user) {
            return true;
        });

        Gate::define('update-intro', function (User $user, $id) {
            return true;
        });

        Gate::define('delete-intro', function (User $user, $id) {
            return true;
        });

        /* LANGUAGE */
        Gate::define('view-languages', function (?User $user) {
            return true;
        });

        /* LOG */
        Gate::define('view-logs', function (User $user) {
            return true;
        });

        Gate::define('show-log', function (User $user, int $id) {
            return true;
        });

        Gate::define('delete-log', function (User $user, int $id) {
            return true;
        });

        /* MESSAGE */
        Gate::define('view-messages', function (User $user) {
            return true;
        });

        Gate::define('show-message', function (User $user, int $id) {
            return true;
        });

        Gate::define('delete-message', function (User $user, int $id) {
            return true;
        });
    }
}