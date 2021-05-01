<?php


namespace Scandinaver\User\Application\Providers;

use Illuminate\Support\ServiceProvider;
use Scandinaver\User\Domain\Contract\Service\AvatarServiceInterface;

/**
 * Class UserServiceProvider
 *
 * @package Scandinaver\User\Application\Providers
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