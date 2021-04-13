<?php


namespace Scandinaver\User\Application\Providers;


use Illuminate\Support\ServiceProvider;
use Scandinaver\User\Domain\Contract\Service\AvatarServiceInterface;

/**
 * Class CustomServiceProvider
 *
 * @package Scandinaver\User\Application\Providers
 */
class CustomServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            AvatarServiceInterface::class,
            'Scandinaver\User\Infrastructure\Service\AvatarService'
        );
    }
}