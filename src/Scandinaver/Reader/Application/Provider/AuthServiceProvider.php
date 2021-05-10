<?php


namespace Scandinaver\Reader\Application\Provider;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Reader\Domain\Permission\Reader;

/**
 * Class AuthServiceProvider
 *
 * @package Scandinaver\Reader\Application\Provider
 */
class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define(Reader::READ, fn(UserInterface $user) => TRUE);
    }
}