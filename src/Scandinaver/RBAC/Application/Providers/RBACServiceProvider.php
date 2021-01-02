<?php


namespace Scandinaver\RBAC\Application\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RBACServiceProvider
 *
 * @package Scandinaver\RBAC\Application\Providers
 *
 * THIS CLASS IS AUTOGENERATED. DONT CHANGE IT MANUALLY.
 */
class RBACServiceProvider extends ServiceProvider
{
    public function register()
    {
        /** COMMAND **/
        $this->app->bind(
            'AttachPermissionToRoleHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\AttachPermissionToRoleHandler'
        );

        $this->app->bind(
            'CreatePermissionHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\CreatePermissionHandler'
        );

        $this->app->bind(
            'CreatePermissionGroupHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\CreatePermissionGroupHandler'
        );

        $this->app->bind(
            'CreateRoleHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\CreateRoleHandler'
        );

        $this->app->bind(
            'DeletePermissionHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\DeletePermissionHandler'
        );

        $this->app->bind(
            'DeletePermissionGroupHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\DeletePermissionGroupHandler'
        );

        $this->app->bind(
            'DeleteRoleHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\DeleteRoleHandler'
        );

        $this->app->bind(
            'DetachPermissionFromRoleHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\DetachPermissionFromRoleHandler'
        );

        $this->app->bind(
            'UpdatePermissionHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\UpdatePermissionHandler'
        );

        $this->app->bind(
            'UpdatePermissionGroupHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\UpdatePermissionGroupHandler'
        );

        $this->app->bind(
            'UpdateRoleHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Command\UpdateRoleHandler'
        );

        /** QUERY **/
        $this->app->bind(
            'PermissionGroupHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Query\PermissionGroupHandler'
        );

        $this->app->bind(
            'PermissionGroupsHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Query\PermissionGroupsHandler'
        );

        $this->app->bind(
            'PermissionHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Query\PermissionHandler'
        );

        $this->app->bind(
            'PermissionsHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Query\PermissionsHandler'
        );

        $this->app->bind(
            'RoleHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Query\RoleHandler'
        );

        $this->app->bind(
            'RolesHandlerInterface',
            'Scandinaver\RBAC\Application\Handler\Query\RolesHandler'
        );
    }
}