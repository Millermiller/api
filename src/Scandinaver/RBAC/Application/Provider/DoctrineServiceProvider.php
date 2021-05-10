<?php


namespace Scandinaver\RBAC\Application\Provider;


use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionGroupRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\PermissionRepositoryInterface;
use Scandinaver\RBAC\Domain\Contract\Repository\RoleRepositoryInterface;
use Scandinaver\RBAC\Domain\Model\{Permission, PermissionGroup, Role};
use Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\PermissionGroupRepository;
use Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\PermissionRepository;
use Scandinaver\RBAC\Infrastructure\Persistence\Doctrine\RoleRepository;

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

        $this->app->bind(RoleRepositoryInterface::class,
            fn() => new RoleRepository($em, $em->getClassMetadata(Role::class))
        );

        $this->app->bind(PermissionRepositoryInterface::class,
            fn() => new PermissionRepository($em, $em->getClassMetadata(Permission::class))
        );

        $this->app->bind(PermissionGroupRepositoryInterface::class,
            fn() => new PermissionGroupRepository($em, $em->getClassMetadata(PermissionGroup::class))
        );
    }
}