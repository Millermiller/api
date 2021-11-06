<?php


namespace Scandinaver\Learning\Translate\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Learning\Translate\Domain\Permission\Text;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Translate\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Gate::define(Text::VIEW, fn(UserInterface $user): bool => $user->can(Text::VIEW));

        Gate::define(Text::SHOW, fn(UserInterface $user, int $textId): bool => $user->can(Text::SHOW));

        Gate::define('complete-text', fn(UserInterface $user, int $textId): bool => $user->can('complete-text'));

        Gate::define(Text::CREATE, fn(UserInterface $user): bool => $user->can(Text::CREATE));

        Gate::define(Text::UPDATE, fn(UserInterface $user, int $textId): bool => $user->can(Text::UPDATE));

        Gate::define(Text::DELETE, fn(UserInterface $user, int $textId): bool => $user->can(Text::DELETE));
    }
}