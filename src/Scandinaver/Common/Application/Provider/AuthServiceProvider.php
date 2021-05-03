<?php


namespace Scandinaver\Common\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Permission\{Intro, Language, Log, Message};
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\User\Domain\Model\User;

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
        Gate::define(Language::VIEW,
            function (?UserInterface $user) {
                return $user->can(Language::VIEW);
            });

        Gate::define(Language::SHOW,
            function (?UserInterface $user) {
                return $user->can(Language::SHOW);
            });

        Gate::define(Language::CREATE,
            function (?User $user) {
                return $user->can(Language::CREATE);
            });

        Gate::define(Language::UPDATE,
            function (?UserInterface $user) {
                return $user->can(Language::UPDATE);
            });

        Gate::define(Language::DELETE,
            function (?UserInterface $user) {
                return $user->can(Language::DELETE);
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