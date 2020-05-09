<?php


namespace Scandinaver\Translate\Application;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteServiceProvider
 *
 * @package Scandinaver\Translate\Application
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
                'middleware' => ['web', 'checkDomain', 'touchUser', 'checkPlan', 'auth:api'],
                'namespace'  => 'App\Http\Controllers',
                'as'         => 'sub_frontend::'
            ],
            function () {
                Route::get('/{language}/text/{text}', 'Sub\Frontend\TextController@show');
                Route::get('/{language}/syns/{id}', 'Sub\Frontend\TextController@getSyns');
                Route::post('/{language}/nextTLevel', 'Sub\Frontend\TextController@nextLevel');
            }
        );

        Route::group(
            [
                'middleware' => ['checkAdmin', 'checkDomain', 'touchUser'],
                'namespace'  => 'App\Http\Controllers\Sub\Backend',
                'prefix'     => 'admin'
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
