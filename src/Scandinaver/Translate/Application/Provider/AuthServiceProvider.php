<?php


namespace Scandinaver\Translate\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Translate\Domain\Permission\Text;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Translate\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(Text::VIEW, function (UserInterface $user) {
            return TRUE;
        });

        Gate::define(Text::SHOW, function (UserInterface $user, int $textId) {
            return TRUE;
        });

        Gate::define('complete-text', function (UserInterface $user, int $textId) {
            return TRUE;
        });

        Gate::define(Text::CREATE, function (UserInterface $user) {
            return TRUE;
        });

        Gate::define(Text::UPDATE, function (UserInterface $user, int $textId) {
            return TRUE;
        });

        Gate::define(Text::DELETE, function (UserInterface $user, int $textId) {
            return TRUE;
        });
    }
}