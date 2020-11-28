<?php


namespace Scandinaver\Translate\Infrastructure;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\User\Domain\Model\User;


class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('view-texts', function (User $user) {
            return true;
        });

        Gate::define('show-text', function (User $user, int $textId) {
            return true;
        });

        Gate::define('complete-text', function (User $user, int $textId) {
            return true;
        });

        Gate::define('create-text', function (User $user) {
            return true;
        });

        Gate::define('update-text', function (User $user, int $textId) {
            return true;
        });

        Gate::define('delete-text', function (User $user, int $textId) {
            return true;
        });
    }
}