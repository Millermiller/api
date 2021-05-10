<?php


namespace Scandinaver\User\Application\Provider;

use Doctrine\ORM\EntityManager;
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
        /** @var EntityManager $em */
        $em = $this->app['em'];

        $this->app->bind(
            UserRepositoryInterface::class,
            fn() => new UserRepository($em, $em->getClassMetadata(User::class))
        );

        $this->app->bind(
            PlanRepositoryInterface::class,
            fn() => new PlanRepository($em, $em->getClassMetadata(Plan::class))
        );

        $this->app->bind(
            RoleRepositoryInterface::class,
            fn() => new RoleRepository($em, $em->getClassMetadata(Role::class))
        );

        $this->app->bind(
            PermissionRepositoryInterface::class,
            fn() => new PermissionRepository($em, $em->getClassMetadata(Permission::class))
        );
    }
}