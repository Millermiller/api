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

        $this->app->bind(
            'LoginHandlerInterface',
            'Scandinaver\User\Application\Handlers\LoginHandler'
        );

        $this->app->bind(
            'LogoutHandlerInterface',
            'Scandinaver\User\Application\Handlers\LogoutHandler'
        );

        $this->app->bind(
            'UserStateHandlerInterface',
            'Scandinaver\User\Application\Handlers\UserStateHandler'
        );

        $this->app->bind(
            'UsersHandlerInterface',
            'Scandinaver\User\Application\Handlers\UsersHandler'
        );

        $this->app->bind(
            'UserHandlerInterface',
            'Scandinaver\User\Application\Handlers\UserHandler'
        );

        $this->app->bind(
            'UpdateUserHandlerInterface',
            'Scandinaver\User\Application\Handlers\UpdateUserHandler'
        );

        $this->app->bind(
            'UpdatePlanHandlerInterface',
            'Scandinaver\User\Application\Handlers\UpdatePlanHandler'
        );

        $this->app->bind(
            'PlansHandlerInterface',
            'Scandinaver\User\Application\Handlers\PlansHandler'
        );

        $this->app->bind(
            'PlanHandlerInterface',
            'Scandinaver\User\Application\Handlers\PlanHandler'
        );

        $this->app->bind(
            'DeleteUserHandlerInterface',
            'Scandinaver\User\Application\Handlers\DeleteUserHandler'
        );

        $this->app->bind(
            'DeletePlanHandlerInterface',
            'Scandinaver\User\Application\Handlers\DeletePlanHandler'
        );

        $this->app->bind(
            'CreateUserHandlerInterface',
            'Scandinaver\User\Application\Handlers\CreateUserHandler'
        );

        $this->app->bind(
            'CreatePlanHandlerInterface',
            'Scandinaver\User\Application\Handlers\CreatePlanHandler'
        );

        $this->app->bind(
            'GetStateHandlerInterface',
            'Scandinaver\User\Application\Handlers\GetStateHandler'
        );
    }
}