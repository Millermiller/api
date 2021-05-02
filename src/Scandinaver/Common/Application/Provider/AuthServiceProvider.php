<?php


namespace Scandinaver\Common\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Permission\{Intro, Log, Message};
use Scandinaver\Common\Domain\Contract\UserInterface;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Common\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /* INTRO */
        Gate::define(Intro::VIEW,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Intro::SHOW,
            function (UserInterface $user, $id) {
                return TRUE;
            });

        Gate::define(Intro::CREATE,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Intro::UPDATE,
            function (UserInterface $user, $id) {
                return TRUE;
            });

        Gate::define(Intro::DELETE,
            function (UserInterface $user, $id) {
                return TRUE;
            });

        /* LANGUAGE */
        Gate::define('view-languages',
            function (?UserInterface $user) {
                return TRUE;
            });

        /* LOG */
        Gate::define(Log::VIEW,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Log::SHOW,
            function (UserInterface $user, int $id) {
                return TRUE;
            });

        Gate::define(Log::DELETE,
            function (UserInterface $user, int $id) {
                return TRUE;
            });

        /* MESSAGE */
        Gate::define(Message::VIEW,
            function (UserInterface $user) {
                return TRUE;
            });

        Gate::define(Message::SHOW,
            function (UserInterface $user, int $id) {
                return TRUE;
            });

        Gate::define(Message::DELETE,
            function (UserInterface $user, int $id) {
                return TRUE;
            });
    }
}