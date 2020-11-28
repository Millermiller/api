<?php


namespace Scandinaver\Learn\Infrastructure;


use Illuminate\Support\ServiceProvider;
use Scandinaver\Learn\Domain\Contract\Service\TranslaterInterface;

/**
 * Class CustomServiceProvider
 *
 * @package Scandinaver\Learn\Infrastructure
 */
class CustomServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TranslaterInterface::class,
            'Scandinaver\Learn\Infrastructure\YandexTranslater'
        );
    }
}