<?php


namespace Scandinaver\User\Infrastructure;


use Illuminate\Support\ServiceProvider;
use Scandinaver\User\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Model\Plan;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\PlanRepository;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\UserRepository;

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
    }
}