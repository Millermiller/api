<?php


namespace Scandinaver\Learning\Asset\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Learning\Asset\Domain\Permission\Asset;
use Scandinaver\Learning\Asset\Domain\Permission\Card;
use Scandinaver\Learning\Asset\Domain\Permission\Test;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Learn\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        /* ASSET */
        Gate::define(Asset::VIEW, fn(UserInterface $user): bool => $user->can(Asset::VIEW));

        Gate::define(Asset::SHOW, fn(UserInterface $user, $id): bool => $user->can(Asset::SHOW));

        Gate::define(Asset::CREATE, fn(UserInterface $user): bool => $user->can(Asset::CREATE));

        Gate::define(Asset::UPDATE, fn(UserInterface $user, $id): bool => $user->can(Asset::UPDATE));

        Gate::define(Asset::DELETE, fn(UserInterface $user, $id): bool => $user->can(Asset::DELETE));

        Gate::define(Asset::ADD_CARD, fn(UserInterface $user): bool => TRUE);

        /* FAVOURITE */
        Gate::define(Asset::CREATE_FAVOURITE,
            fn(UserInterface $user, $id): bool => $user->can(Asset::CREATE_FAVOURITE));

        Gate::define(Asset::DELETE_FAVOURITE,
            fn(UserInterface $user, $id): bool => $user->can(Asset::DELETE_FAVOURITE));

        /* CARD */
        Gate::define(Card::VIEW, fn(UserInterface $user): bool => $user->can(Card::VIEW));

        Gate::define(Card::CREATE, fn(UserInterface $user): bool => $user->can(Card::CREATE));

        Gate::define(Card::UPDATE, fn(UserInterface $user, $id): bool => $user->can(Card::UPDATE));

        Gate::define(Card::DELETE, fn(UserInterface $user, int $assetId): bool => $user->can(Card::DELETE));

        Gate::define(Card::SEARCH, fn(UserInterface $user): bool => $user->can(Card::SEARCH));

        /* TEST */

        Gate::define(Test::COMPLETE, fn(UserInterface $user, $assetId): bool => $user->can(Test::COMPLETE));

        Gate::define(Test::GET_ALL_PASSINGS, fn(UserInterface $user): bool => $user->can(Test::GET_ALL_PASSINGS));

        Gate::define(Test::DELETE_PASSING,
            fn(UserInterface $user, $passingId): bool => $user->can(Test::DELETE_PASSING));

        Gate::define(Test::UPDATE_PASSING,
            fn(UserInterface $user, $passingId): bool => $user->can(Test::UPDATE_PASSING));
    }
}