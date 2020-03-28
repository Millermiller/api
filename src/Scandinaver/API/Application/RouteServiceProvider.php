<?php


namespace Scandinaver\API\Application;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 *
 * @package Scandinaver\Learn\Application
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::group(
            [
                'namespace' => 'App\Http\Controllers\API',
                'as'        => 'api::'
            ],
            function () {
                Route::get('/api/languages', 'ApiController@languages')->name('languages');

                Route::get('/api/assets/{language}', 'ApiController@assets')->middleware('auth:api')->name('assets');

                Route::get('/api/user', 'ApiController@user')->middleware('auth:api')->name('user');
            }
        );

        parent::boot();
    }
}