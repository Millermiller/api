<?php


namespace Scandinaver\Puzzle\Application;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 *
 * @package Scandinaver\Puzzle\Application
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
                'domain'     => '{subdomain}.' . config('app.DOMAIN'),
                'middleware' => ['web', 'checkDomain', 'touchUser', 'checkPlan', 'auth:api'],
                'namespace'  => 'App\Http\Controllers\Sub\Frontend',
                'as'         => 'sub_frontend::'
            ],
            function () {
                Route::resource('/{language}/puzzle', 'PuzzleController', ['except' => ['create', 'delete']]);
            }
        );

        Route::group(
            [
                'domain'     => '{subdomain}.' . config('app.DOMAIN'),
                'middleware' => ['checkAdmin', 'checkDomain', 'touchUser'],
                'namespace'  => 'App\Http\Controllers\Sub\Backend',
                'prefix'     => 'admin'
            ],
            function () {
                Route::resource('/puzzle', 'PuzzleController');
            }
        );

        parent::boot();
    }
}
