<?php


namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 *
 * @package App\Provider
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

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void
    {
        Route::get('/', 'App\Http\Controllers\IndexController@index');

        Route::middleware(['web'])->group(base_path('routes/web/routes.php'));

        Route::as('auth::')->group(base_path('routes/api/auth.php'));

        /****/
        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/asset.php'));

        Route::middleware([])->group(base_path('routes/api/blog.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/card.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/common.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/favourite.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/intro.php'));

        Route::middleware(['auth:api'])->group(base_path('routes/api/language.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/log.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/message.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/meta.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/payment.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/profile.php'));

        Route::middleware(['auth:api'])->group(base_path('routes/api/puzzle.php'));

        Route::middleware(['auth:api'])->group(base_path('routes/api/role.php'));

        Route::middleware(['auth:api'])->group(base_path('routes/api/permission.php'));

        Route::middleware(['auth:api'])->group(base_path('routes/api/permission-group.php'));

        Route::middleware(['auth:api'])->group(base_path('routes/api/settings.php'));

        Route::middleware(['auth:api', 'touchUser',])->group(base_path('routes/api/user.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/tariff.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/test.php'));

        Route::middleware(['auth:api', 'touchUser', 'checkPlan'])->group(base_path('routes/api/translate.php'));


    }
}
