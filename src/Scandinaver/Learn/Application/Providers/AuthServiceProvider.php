<?php


namespace Scandinaver\Learn\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Learn\Domain\Permissions\Asset;
use Scandinaver\Learn\Domain\Permissions\Card;
use Scandinaver\Learn\Domain\Permissions\Test;
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

        Gate::define(Asset::ADD_CARD, function (User $user) {
            return TRUE;
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

        Gate::define(Card::DELETE, function (User $user, int $assetId) {
            return $user->can(Card::DELETE);
        });

        Gate::define(Card::SEARCH, function (User $user) {
            return $user->can(Card::SEARCH);
        });

        /* TEST */

        Gate::define(Test::COMPLETE, function (User $user, $assetId) {
            return TRUE;
        });

        Gate::define(Test::GET_ALL_PASSINGS, function (User $user) {
            return TRUE;
        });

        Gate::define(Test::DELETE_PASSING, function (User $user, $passingId) {
            return TRUE;
        });

        Gate::define(Test::UPDATE_PASSING, function (User $user, $passingId) {
            return TRUE;
        });
    }
}