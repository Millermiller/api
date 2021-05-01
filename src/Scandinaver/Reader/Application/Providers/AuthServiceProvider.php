<?php


namespace Scandinaver\Reader\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Reader\Domain\Permissions\Reader;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Reader\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(Reader::READ, function (UserInterface $user) {
            return TRUE;
        });
    }
}