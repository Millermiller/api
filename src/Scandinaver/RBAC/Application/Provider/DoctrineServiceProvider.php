<?php


namespace Scandinaver\RBAC\Application\Provider;


use Illuminate\Support\ServiceProvider;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionGroupRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\RBAC\Domain\Entity\{Permission, PermissionGroup, Role};
use Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\Repository\PermissionGroupRepository;
use Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\Repository\PermissionRepository;
use Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\Repository\RoleRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\User\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            RoleRepositoryInterface::class,
            function () {
                return new RoleRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Role::class)
                );
            }
        );

        $this->app->bind(
            PermissionRepositoryInterface::class,
            function () {
                return new PermissionRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Permission::class)
                );
            }
        );

        $this->app->bind(
            PermissionGroupRepositoryInterface::class,
            function () {
                return new PermissionGroupRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(PermissionGroup::class)
                );
            }
        );
    }
}