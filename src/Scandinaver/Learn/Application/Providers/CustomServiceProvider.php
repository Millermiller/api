<?php


namespace Scandinaver\Learn\Application\Providers;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Learn\Domain\Contract\AudioParserInterface;
use Scandinaver\Learn\Domain\Contract\Service\TranslaterInterface;

/**
 * Class CustomServiceProvider
 *
 * @package Scandinaver\Learn\Application\Providers
 */
class CustomServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TranslaterInterface::class,
            'Scandinaver\Learn\Infrastructure\Service\YandexTranslater'
        );

        $this->app->bind(
            AudioParserInterface::class,
            'Scandinaver\Learn\Infrastructure\Service\ForvoParser'
        );
    }
}