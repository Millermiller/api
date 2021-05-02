<?php


namespace Scandinaver\Settings\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Settings\Domain\Permission\Settings;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Settings\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(Settings::VIEW,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Settings::SHOW,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(Settings::CREATE,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Settings::UPDATE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(Settings::DELETE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });
    }
}