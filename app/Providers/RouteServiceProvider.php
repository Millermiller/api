<?php


namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 *
 * @package App\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::post('/feedback', 'Main\Frontend\IndexController@feedback');

        Route::group(
            [
                'namespace' => 'App\Http\Controllers\API',
                'as'        => 'mobile::'
            ],
            function () {
                Route::get('/languages', 'ApiController@languages')->name('languages');
                Route::get('/assets/{language}', 'ApiController@assets')->middleware('auth:api')->name('assets');
            }
        );

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void
    {
        $this->mapWebRoutes();

        $this->mapAuthRoutes();

        $this->mapFrontendRoutes();
       // $this->mapSubBackendRoutes();

        $this->mapSubfrontendRoutes();
    }

    protected function mapWebRoutes(): void
    {
        Route::middleware(['web'])
             ->group(base_path('routes/web/routes.php'));
    }

    protected function mapAuthRoutes(): void
    {
        Route::namespace('App\Http\Controllers\Auth')
             ->as('auth::')
             ->group(base_path('routes/api/auth.php'));
    }

    protected function mapBackendRoutes(): void
    {
        Route::middleware(['auth:api', 'checkAdmin'])
             ->prefix('admin')
             ->namespace('App\Http\Controllers\Main\Backend')
             ->as('backend::')
             ->group(base_path('routes/api/backend/routes.php'));
    }

    protected function mapFrontendRoutes(): void
    {
        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])
             ->namespace('App\Http\Controllers\Main\Frontend')
             ->as('frontend::')
             ->group(base_path('routes/api/frontend/profile.php'));
    }

    protected function mapSubfrontendRoutes(): void
    {
        Route::middleware(['bindings', 'auth:api', 'touchUser', 'checkPlan'])
             ->namespace('App\Http\Controllers\Sub\Frontend')
             ->as('sub_frontend::')
             ->group(base_path('routes/api/subfrontend/common.php'));

        Route::middleware(['bindings', 'auth:api', 'touchUser', 'checkPlan'])
             ->namespace('App\Http\Controllers\Sub\Frontend')
             ->as('sub_frontend::')
             ->group(base_path('routes/api/subfrontend/learn.php'));

        Route::middleware(['bindings', 'auth:api','touchUser', 'checkPlan'])
             ->namespace('App\Http\Controllers\Sub\Frontend')
             ->as('sub_frontend::')
             ->group(base_path('routes/api/subfrontend/puzzle.php'));

        Route::middleware(['bindings', 'auth:api', 'touchUser', 'checkPlan'])
             ->namespace('App\Http\Controllers\Sub\Frontend')
             ->as('sub_frontend::')
             ->group(base_path('routes/api/subfrontend/translate.php'));
    }

    protected function mapSubBackendRoutes(): void
    {
        Route::middleware(['bindings', 'auth:api', 'checkAdmin'])
             ->namespace('App\Http\Controllers\Sub\Backend')
             ->as('sub_backend::')
             ->group(base_path('routes/api/subbackend/routes.php'));
    }
}
