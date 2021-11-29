<?php


namespace Scandinaver\Settings\Application\Provider;


use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;
use Scandinaver\Settings\Domain\Contract\Repository\SettingRepositoryInterface;
use Scandinaver\Settings\Domain\Entity\Setting;
use Scandinaver\Settings\Infrastructure\Persistence\Doctrine\Repository\SettingRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Settings\Application\Provider
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