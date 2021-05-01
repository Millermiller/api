<?php


namespace Scandinaver\User\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\User\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(\Scandinaver\User\Domain\Permissions\User::VIEW,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(\Scandinaver\User\Domain\Permissions\User::SHOW,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(\Scandinaver\User\Domain\Permissions\User::CREATE,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(\Scandinaver\User\Domain\Permissions\User::UPDATE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(\Scandinaver\User\Domain\Permissions\User::DELETE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });
    }
}