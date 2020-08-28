<?php


namespace Scandinaver\User\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Scandinaver\User\Domain\Contract\Repository\PlanRepositoryInterface;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Model\Plan;
use Scandinaver\User\Domain\Model\User;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\PlanRepository;
use Scandinaver\User\Infrastructure\Persistence\Doctrine\UserRepository;

/**
 * Class UserServiceProvider
 *
 * @package Scandinaver\User\Application
 */
class UserServiceProvider extends ServiceProvider
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
            'LoginHandlerInterface',
            'Scandinaver\User\Application\Handler\Command\LoginHandler'
        );

        $this->app->bind(
            'LogoutHandlerInterface',
            'Scandinaver\User\Application\Handler\Command\LogoutHandler'
        );

        $this->app->bind(
            'UserStateHandlerInterface',
            'Scandinaver\User\Application\Handler\Query\UserStateHandler'
        );

        $this->app->bind(
            'UsersHandlerInterface',
            'Scandinaver\User\Application\Handler\Query\UsersHandler'
        );

        $this->app->bind(
            'UserHandlerInterface',
            'Scandinaver\User\Application\Handler\Query\UserHandler'
        );

        $this->app->bind(
            'UpdateUserHandlerInterface',
            'Scandinaver\User\Application\Handler\Command\UpdateUserHandler'
        );

        $this->app->bind(
            'UpdatePlanHandlerInterface',
            'Scandinaver\User\Application\Handler\Command\UpdatePlanHandler'
        );

        $this->app->bind(
            'PlansHandlerInterface',
            'Scandinaver\User\Application\Handler\Query\PlansHandler'
        );

        $this->app->bind(
            'PlanHandlerInterface',
            'Scandinaver\User\Application\Handler\Query\PlanHandler'
        );

        $this->app->bind(
            'DeleteUserHandlerInterface',
            'Scandinaver\User\Application\Handler\Command\DeleteUserHandler'
        );

        $this->app->bind(
            'DeletePlanHandlerInterface',
            'Scandinaver\User\Application\Handler\Command\DeletePlanHandler'
        );

        $this->app->bind(
            'CreateUserHandlerInterface',
            'Scandinaver\User\Application\Handler\Command\CreateUserHandler'
        );

        $this->app->bind(
            'CreatePlanHandlerInterface',
            'Scandinaver\User\Application\Handler\Command\CreatePlanHandler'
        );

        $this->app->bind(
            'GetStateHandlerInterface',
            'Scandinaver\User\Application\Handler\Query\GetStateHandler'
        );

        $this->app->bind(
            'GetUserHandlerInterface',
            'Scandinaver\User\Application\Handler\Query\GetUserHandler'
        );
    }
}