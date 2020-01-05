<?php

namespace Scandinaver\Text\Application;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
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
                'domain' => '{subdomain}.' . config('app.DOMAIN'),
                'middleware' => ['web', 'checkDomain', 'touchUser', 'checkPlan'],
                'namespace' => 'App\Http\Controllers\Sub\Frontend',
                'as' => 'sub_frontend::'
            ],
            function () {
                Route::resource('/text', 'TextController')->only(['show']);
                Route::get('/syns/{id}', 'TextController@getSyns');
                Route::post('/nextTLevel', 'TextController@nextLevel');
            }
        );

        Route::group(
            [
                'domain' => '{subdomain}.' . config('app.DOMAIN'),
                'middleware' => ['checkAdmin', 'checkDomain', 'touchUser'],
                'namespace' => 'App\Http\Controllers\Sub\Backend',
                'prefix' => 'admin'
            ],
            function () {
                Route::get('/texts', 'TextController@index');
                Route::post('/text/publish', 'TextController@publish');
                Route::post('/text/{id}', 'TextController@textedit');
                Route::post('/text', 'TextController@textcreate');
                Route::delete('/text/{id}', 'TextController@textdelete');
                Route::get('/text/{id}', 'TextController@getText');
                Route::post('/text/extra', 'TextController@addExtras');
                Route::post('/text/sentences', 'TextController@saveSentences');
                Route::get('/text/synonyms/{id}', 'TextController@getSynonyms');
                Route::post('/text/synonym', 'TextController@addSynonym');
                Route::delete('/text/synonym/{id}', 'TextController@deleteSynonym');
                Route::post('/text/image/{id}', 'TextController@uploadImage');
                Route::post('/text/description/{id}', 'TextController@updateDescription');
            }
        );

        parent::boot();
    }
}
