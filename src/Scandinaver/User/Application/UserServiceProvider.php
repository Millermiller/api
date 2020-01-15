<?php


namespace Scandinaver\User\Application;

use Illuminate\Support\ServiceProvider;
use Scandinaver\User\Domain\Contracts\PlanRepositoryInterface;
use Scandinaver\User\Domain\Contracts\UserRepositoryInterface;
use Scandinaver\User\Domain\{Plan, User};
use Scandinaver\User\Infrastructure\Persistence\Doctrine\PlanRepository;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\UserRepository;

/**
 * Class UserServiceProvider
 * @package Scandinaver\User\Application
 */
class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(User::class)
            );
        });

        $this->app->bind(PlanRepositoryInterface::class, function () {
            return new PlanRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Plan::class)
            );
        });
    }
}