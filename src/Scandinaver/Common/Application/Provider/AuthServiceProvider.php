<?php


namespace Scandinaver\Common\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Permission\{Intro, Language, Log, Message};
use Scandinaver\User\Domain\Entity\User;

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
            fn(UserInterface $user): bool => $user->can(Intro::VIEW));

        Gate::define(Intro::SHOW,
            fn(UserInterface $user, $id): bool => $user->can(Intro::SHOW));

        Gate::define(Intro::CREATE,
            fn(UserInterface $user): bool => $user->can(Intro::CREATE));

        Gate::define(Intro::UPDATE,
            fn(UserInterface $user, $id): bool => $user->can(Intro::UPDATE));

        Gate::define(Intro::DELETE,
            fn(UserInterface $user, $id): bool => $user->can(Intro::DELETE));

        /* LANGUAGE */
        Gate::define(Language::VIEW,
            fn(?UserInterface $user): bool => TRUE);

        Gate::define(Language::SHOW,
            fn(?UserInterface $user): bool => $user->can(Language::SHOW));

        Gate::define(Language::CREATE,
            fn(?User $user): bool => $user->can(Language::CREATE));

        Gate::define(Language::UPDATE,
            fn(?UserInterface $user): bool => $user->can(Language::UPDATE));

        Gate::define(Language::DELETE,
            fn(?UserInterface $user): bool => $user->can(Language::DELETE));

        /* LOG */
        Gate::define(Log::VIEW,
            fn(UserInterface $user): bool =>  $user->can(Log::VIEW));

        Gate::define(Log::SHOW,
            fn(UserInterface $user, int $id): bool => $user->can(Log::SHOW));

        Gate::define(Log::DELETE,
            fn(UserInterface $user, int $id): bool => $user->can(Log::DELETE));

        /* MESSAGE */
        Gate::define(Message::VIEW,
            fn(UserInterface $user): bool => $user->can(Message::VIEW));

        Gate::define(Message::SHOW,
            fn(UserInterface $user, int $id): bool => $user->can(Message::SHOW));

        Gate::define(Message::DELETE,
            fn(UserInterface $user, int $id): bool => $user->can(Message::DELETE));
    }
}