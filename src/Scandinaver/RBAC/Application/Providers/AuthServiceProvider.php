<?php


namespace Scandinaver\RBAC\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\RBAC\Domain\Permissions\Permission;
use Scandinaver\RBAC\Domain\Permissions\PermissionGroup;
use Scandinaver\RBAC\Domain\Permissions\Role;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\User\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(Role::VIEW,
            function (User $user) {
                return TRUE;
            });

        Gate::define(Role::SHOW,
            function (User $user, int $userId) {
                return TRUE;
            });

        Gate::define(Role::CREATE,
            function (User $user) {
                return TRUE;
            });

        Gate::define(Role::UPDATE,
            function (User $user, int $userId) {
                return TRUE;
            });

        Gate::define(Role::DELETE,
            function (User $user, int $userId) {
                return TRUE;
            });

        Gate::define(Permission::VIEW,
            function (User $user) {
                return TRUE;
            });

        Gate::define(Permission::SHOW,
            function (User $user, int $userId) {
                return TRUE;
            });

        Gate::define(Permission::CREATE,
            function (User $user) {
                return TRUE;
            });

        Gate::define(Permission::UPDATE,
            function (User $user, int $userId) {
                return TRUE;
            });

        Gate::define(Permission::DELETE,
            function (User $user, int $userId) {
                return TRUE;
            });

        Gate::define(PermissionGroup::VIEW,
            function (User $user) {
                return TRUE;
            });

        Gate::define(PermissionGroup::SHOW,
            function (User $user, int $userId) {
                return TRUE;
            });

        Gate::define(PermissionGroup::CREATE,
            function (User $user) {
                return TRUE;
            });

        Gate::define(PermissionGroup::UPDATE,
            function (User $user, int $userId) {
                return TRUE;
            });

        Gate::define(PermissionGroup::DELETE,
            function (User $user, int $userId) {
                return TRUE;
            });
    }
}