<?php


namespace Scandinaver\RBAC\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\RBAC\Domain\Permission\Permission;
use Scandinaver\RBAC\Domain\Permission\PermissionGroup;
use Scandinaver\RBAC\Domain\Permission\Role;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\User\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Gate::define(Role::VIEW, fn(UserInterface $user): bool => $user->can(Role::VIEW));

        Gate::define(Role::SHOW, fn(UserInterface $user, int $userId): bool => $user->can(Role::SHOW));

        Gate::define(Role::CREATE, fn(UserInterface $user): bool => $user->can(Role::CREATE));

        Gate::define(Role::UPDATE, fn(UserInterface $user, int $userId): bool => $user->can(Role::UPDATE));

        Gate::define(Role::DELETE, fn(UserInterface $user, int $userId): bool => $user->can(Role::DELETE));

        Gate::define(Permission::VIEW, fn(UserInterface $user): bool => $user->can(Permission::VIEW));

        Gate::define(Permission::SHOW, fn(UserInterface $user, int $userId): bool => $user->can(Permission::SHOW));

        Gate::define(Permission::CREATE, fn(UserInterface $user): bool => $user->can(Permission::CREATE));

        Gate::define(Permission::UPDATE, fn(UserInterface $user, int $userId): bool => $user->can(Permission::UPDATE));

        Gate::define(Permission::DELETE, fn(UserInterface $user, int $userId): bool => $user->can(Permission::DELETE));

        Gate::define(PermissionGroup::VIEW, fn(UserInterface $user): bool => $user->can(PermissionGroup::VIEW));

        Gate::define(PermissionGroup::SHOW,
            fn(UserInterface $user, int $userId): bool => $user->can(PermissionGroup::SHOW));

        Gate::define(PermissionGroup::CREATE, fn(UserInterface $user): bool => $user->can(PermissionGroup::CREATE));

        Gate::define(PermissionGroup::UPDATE,
            fn(UserInterface $user, int $userId): bool => $user->can(PermissionGroup::UPDATE));

        Gate::define(PermissionGroup::DELETE,
            fn(UserInterface $user, int $userId): bool => $user->can(PermissionGroup::DELETE));
    }
}