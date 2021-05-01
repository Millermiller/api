<?php


namespace Scandinaver\RBAC\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\RBAC\Domain\Permissions\Permission;
use Scandinaver\RBAC\Domain\Permissions\PermissionGroup;
use Scandinaver\RBAC\Domain\Permissions\Role;

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
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Role::SHOW,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(Role::CREATE,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Role::UPDATE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(Role::DELETE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(Permission::VIEW,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Permission::SHOW,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(Permission::CREATE,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Permission::UPDATE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(Permission::DELETE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(PermissionGroup::VIEW,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(PermissionGroup::SHOW,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(PermissionGroup::CREATE,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(PermissionGroup::UPDATE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });

        Gate::define(PermissionGroup::DELETE,
            function (UserInterface $user, int $userId) {
                return TRUE;
            });
    }
}