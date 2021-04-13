<?php


namespace Scandinaver\Common\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Permissions\{Intro, Log, Message};
use Scandinaver\User\Domain\Model\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Common\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /* INTRO */
        Gate::define(Intro::VIEW,
            function (User $user) {
                return TRUE;
            });

        Gate::define(Intro::SHOW,
            function (User $user, $id) {
                return TRUE;
            });

        Gate::define(Intro::CREATE,
            function (User $user) {
                return TRUE;
            });

        Gate::define(Intro::UPDATE,
            function (User $user, $id) {
                return TRUE;
            });

        Gate::define(Intro::DELETE,
            function (User $user, $id) {
                return TRUE;
            });

        /* LANGUAGE */
        Gate::define('view-languages',
            function (?User $user) {
                return TRUE;
            });

        /* LOG */
        Gate::define(Log::VIEW,
            function (User $user) {
                return TRUE;
            });

        Gate::define(Log::SHOW,
            function (User $user, int $id) {
                return TRUE;
            });

        Gate::define(Log::DELETE,
            function (User $user, int $id) {
                return TRUE;
            });

        /* MESSAGE */
        Gate::define(Message::VIEW,
            function (User $user) {
                return TRUE;
            });

        Gate::define(Message::SHOW,
            function (User $user, int $id) {
                return TRUE;
            });

        Gate::define(Message::DELETE,
            function (User $user, int $id) {
                return TRUE;
            });
    }
}