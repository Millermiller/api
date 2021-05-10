<?php


namespace Scandinaver\Settings\Application\Provider;


use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;
use Scandinaver\Settings\Domain\Contract\Repository\SettingRepositoryInterface;
use Scandinaver\Settings\Domain\Model\Setting;
use Scandinaver\Settings\Infrastructure\Persistence\Doctrine\SettingRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Settings\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{
    public function register()
    {
        /** @var EntityManager $em */
        $em = $this->app['em'];

        $this->app->bind(
            SettingRepositoryInterface::class,
            fn() => new SettingRepository($em, $em->getClassMetadata(Setting::class))
        );
    }
}