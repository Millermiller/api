<?php


namespace Scandinaver\Reader\Infrastructure;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\User\Domain\Model\User;


class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('read', function (User $user) {
            return true;
        });
    }
}