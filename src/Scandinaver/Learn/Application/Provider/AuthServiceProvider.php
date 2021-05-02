<?php


namespace Scandinaver\Learn\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Learn\Domain\Permission\Asset;
use Scandinaver\Learn\Domain\Permission\Card;
use Scandinaver\Learn\Domain\Permission\Test;

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
        Gate::define(Asset::VIEW, function (UserInterface $user) {
            return $user->can(Asset::VIEW);
        });

        Gate::define(Asset::SHOW, function (UserInterface $user, $id) {
            return $user->can(Asset::SHOW);
        });

        Gate::define(Asset::CREATE, function (UserInterface $user) {
            return $user->can(Asset::CREATE);
        });

        Gate::define(Asset::UPDATE, function (UserInterface $user, $id) {
            return $user->can(Asset::UPDATE);
        });

        Gate::define(Asset::DELETE, function (UserInterface $user, $id) {
            return $user->can(Asset::DELETE);
        });

        Gate::define(Asset::ADD_CARD, function (UserInterface $user) {
            return TRUE;
        });

        /* FAVOURITE */
        Gate::define(Asset::CREATE_FAVOURITE, function (UserInterface $user, $id) {
            return $user->can(Asset::CREATE_FAVOURITE);
        });

        Gate::define(Asset::DELETE_FAVOURITE, function (UserInterface $user, $id) {
            return $user->can(Asset::DELETE_FAVOURITE);
        });

        /* CARD */
        Gate::define(Card::VIEW, function (UserInterface $user) {
            return $user->can(Card::VIEW);
        });

        Gate::define(Card::CREATE, function (UserInterface $user) {
            return $user->can(Card::CREATE);
        });

        Gate::define(Card::UPDATE, function (UserInterface $user, $id) {
            return $user->can(Card::UPDATE);
        });

        Gate::define(Card::DELETE, function (UserInterface $user, int $assetId) {
            return $user->can(Card::DELETE);
        });

        Gate::define(Card::SEARCH, function (UserInterface $user) {
            return $user->can(Card::SEARCH);
        });

        /* TEST */

        Gate::define(Test::COMPLETE, function (UserInterface $user, $assetId) {
            return TRUE;
        });

        Gate::define(Test::GET_ALL_PASSINGS, function (UserInterface $user) {
            return TRUE;
        });

        Gate::define(Test::DELETE_PASSING, function (UserInterface $user, $passingId) {
            return TRUE;
        });

        Gate::define(Test::UPDATE_PASSING, function (UserInterface $user, $passingId) {
            return TRUE;
        });
    }
}