<?php


namespace Scandinaver\User\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\User\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(\Scandinaver\User\Domain\Permission\User::VIEW,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(\Scandinaver\User\Domain\Permission\User::SHOW,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(\Scandinaver\User\Domain\Permission\User::CREATE,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(\Scandinaver\User\Domain\Permission\User::UPDATE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(\Scandinaver\User\Domain\Permission\User::DELETE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });
    }
}