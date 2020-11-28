<?php


namespace Scandinaver\User\Application\Providers;


use Illuminate\Support\ServiceProvider;
use Scandinaver\User\Domain\Contract\Repository\PermissionRepositoryInterface;
use Scandinaver\User\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\User\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Model\{Plan, Role, User, Permission};
use Scandinaver\User\Infrastructure\Persistence\Doctrine\PermissionRepository;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\PlanRepository;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\RoleRepository;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\UserRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\User\Application\Providers
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