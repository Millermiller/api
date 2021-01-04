<?php


namespace Scandinaver\Learn\Application\Providers;

use Gate;
use Scandinaver\Learn\Domain\Permissions\Card;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Learn\Domain\Permissions\Asset;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Learn\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /* ASSET */
        Gate::define(Asset::VIEW, function (User $user) {
            return $user->can(Asset::VIEW);
        });

        Gate::define(Asset::SHOW, function (User $user, $id) {
            return $user->can(Asset::SHOW);
        });

        Gate::define(Asset::CREATE, function (User $user) {
            return $user->can(Asset::CREATE);
        });

        Gate::define(Asset::UPDATE, function (User $user, $id) {
            return $user->can(Asset::UPDATE);
        });

        Gate::define(Asset::DELETE, function (User $user, $id) {
            return $user->can(Asset::DELETE);
        });

        /* FAVOURITE */
        Gate::define(Asset::CREATE_FAVOURITE, function (User $user, $id) {
            return $user->can(Asset::CREATE_FAVOURITE);
        });

        Gate::define(Asset::DELETE_FAVOURITE, function (User $user, $id) {
            return $user->can(Asset::DELETE_FAVOURITE);
        });

        /* CARD */
        Gate::define(Card::VIEW, function (User $user) {
            return $user->can(Card::VIEW);
        });

        Gate::define(Card::CREATE, function (User $user) {
            return $user->can(Card::CREATE);
        });

        Gate::define(Card::UPDATE, function (User $user, $id) {
            return $user->can(Card::UPDATE);
        });

        Gate::define(Card::DELETE, function (User $user, $id) {
            return $user->can(Card::DELETE);
        });
    }
}