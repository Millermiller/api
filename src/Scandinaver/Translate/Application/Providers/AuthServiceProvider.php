<?php


namespace Scandinaver\Translate\Application\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Translate\Domain\Permissions\Text;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Translate\Application\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(Text::VIEW, function (User $user) {
            return true;
        });

        Gate::define(Text::SHOW, function (User $user, int $textId) {
            return true;
        });

        Gate::define('complete-text', function (User $user, int $textId) {
            return true;
        });

        Gate::define(Text::CREATE, function (User $user) {
            return true;
        });

        Gate::define(Text::UPDATE, function (User $user, int $textId) {
            return true;
        });

        Gate::define(Text::DELETE, function (User $user, int $textId) {
            return true;
        });
    }
}