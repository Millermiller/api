<?php


namespace Scandinaver\API\Application;

use Illuminate\Support\ServiceProvider;

/**
 * Class TextServiceProvider
 * @package Scandinaver\Text\Application
 */
class APIServiceProvider  extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'LanguagesHandlerInterface',
            'Scandinaver\API\Application\Handlers\LanguagesHandler'
        );

        $this->app->bind(
            'AssetsHandlerInterface',
            'Scandinaver\API\Application\Handlers\AssetsHandler'
        );
    }
}