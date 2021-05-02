<?php


namespace Scandinaver\User\Application\Provider;

use Illuminate\Support\ServiceProvider;
use Scandinaver\User\Domain\Contract\Service\AvatarServiceInterface;

/**
 * Class UserServiceProvider
 *
 * @package Scandinaver\User\Application\Provider
 */
class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            AvatarServiceInterface::class,
            'Scandinaver\User\Infrastructure\Service\AvatarService'
        );
    }
}