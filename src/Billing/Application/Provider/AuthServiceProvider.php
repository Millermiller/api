<?php


namespace Scandinaver\Billing\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Billing\Domain\Permission\Order;
use Scandinaver\Billing\Domain\Permission\Payment;
use Scandinaver\Billing\Domain\Permission\Plan;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Billing\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        /*** ORDER ***/
        Gate::define(Order::VIEW, fn(UserInterface $user): bool => $user->can(Order::VIEW));

        Gate::define(Order::SHOW, fn(UserInterface $user, int $id): bool => $user->can(Order::SHOW));

        Gate::define(Order::CREATE, fn(UserInterface $user): bool => $user->can(Order::CREATE));

        Gate::define(Order::UPDATE, fn(UserInterface $user, int $id): bool => $user->can(Order::UPDATE));

        Gate::define(Order::DELETE, fn(UserInterface $user, int $id): bool => $user->can(Order::DELETE));

        /*** PAYMENT ***/
        Gate::define(Payment::VIEW, fn(UserInterface $user): bool => $user->can(Payment::VIEW));

        Gate::define(Payment::SHOW, fn(UserInterface $user, int $id): bool => $user->can(Payment::SHOW));

        Gate::define(Payment::CREATE, fn(UserInterface $user): bool => $user->can(Payment::CREATE));

        Gate::define(Payment::UPDATE, fn(UserInterface $user, int $id): bool => $user->can(Payment::UPDATE));

        Gate::define(Payment::DELETE, fn(UserInterface $user, int $id): bool => $user->can(Payment::DELETE));

        /*** PLAN ***/
        Gate::define(Plan::VIEW, fn(UserInterface $user): bool => $user->can(Plan::VIEW));

        Gate::define(Plan::SHOW, fn(UserInterface $user, int $id): bool => $user->can(Plan::SHOW));

        Gate::define(Plan::CREATE, fn(UserInterface $user): bool => $user->can(Plan::CREATE));

        Gate::define(Plan::UPDATE, fn(UserInterface $user, int $id): bool => $user->can(Plan::UPDATE));

        Gate::define(Plan::DELETE, fn(UserInterface $user, int $id): bool => $user->can(Plan::DELETE));
    }
}