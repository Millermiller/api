<?php


namespace Scandinaver\User\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\User\Domain\Permission\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\User\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Gate::define(User::VIEW, fn(UserInterface $user): bool => $user->can(User::VIEW));

        Gate::define(User::SHOW, fn(UserInterface $user, int $userId): bool => $user->can(User::SHOW));

        Gate::define(User::CREATE, fn(UserInterface $user): bool => $user->can(User::CREATE));

        Gate::define(User::UPDATE, fn(UserInterface $user, int $userId): bool => $user->can(User::UPDATE));

        Gate::define(User::DELETE, fn(UserInterface $user, int $userId): bool => $user->can(User::DELETE));
    }
}