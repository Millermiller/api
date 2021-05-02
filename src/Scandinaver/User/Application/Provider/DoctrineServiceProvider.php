<?php


namespace Scandinaver\User\Application\Provider;

use Illuminate\Support\ServiceProvider;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\RBAC\Domain\Model\Role;
use Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\PermissionRepository;
use Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\RoleRepository;
use Scandinaver\User\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Model\Plan;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\PlanRepository;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\UserRepository;

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
            UserRepositoryInterface::class,
            function () {
                return new UserRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(User::class)
                );
            }
        );

        $this->app->bind(
            PlanRepositoryInterface::class,
            function () {
                return new PlanRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Plan::class)
                );
            }
        );

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
    }
}