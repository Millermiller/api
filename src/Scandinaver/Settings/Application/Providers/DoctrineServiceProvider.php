<?php


namespace Scandinaver\Settings\Application\Providers;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Settings\Domain\Contract\Repository\SettingRepositoryInterface;
use Scandinaver\Settings\Domain\Model\Setting;
use Scandinaver\Settings\Infrastructure\Persistence\Doctrine\SettingRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Settings\Application\Providers
 */
class DoctrineServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            SettingRepositoryInterface::class,
            function () {
                return new SettingRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Setting::class)
                );
            }
        );
    }
}