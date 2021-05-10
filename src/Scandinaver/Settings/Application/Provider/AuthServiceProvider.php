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
        Gate::define(Settings::VIEW, fn(UserInterface $user): bool => $user->can(Settings::VIEW));

        Gate::define(Settings::SHOW, fn(UserInterface $user, int $userId) => $user->can(Settings::SHOW));

        Gate::define(Settings::CREATE, fn(UserInterface $user): bool => $user->can(Settings::CREATE));

        Gate::define(Settings::UPDATE, fn(UserInterface $user, int $userId) => $user->can(Settings::UPDATE));

        Gate::define(Settings::DELETE, fn(UserInterface $user, int $userId): bool => $user->can(Settings::DELETE));
    }
}