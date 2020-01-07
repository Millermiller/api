<?php

namespace Scandinaver\Learn\Application;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Scandinaver\Learn\Domain\Word;

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
                Route::get('/words', 'IndexController@getWords')->name('words');
                Route::get('/sentences', 'IndexController@getSentences')->name('sentences');
                Route::get('/personal', 'IndexController@getPersonal')->name('personal');

                Route::get('/assetInfo/{id}', 'AssetController@assetInfo');
                Route::resource('/asset', 'AssetController');

                Route::post('/favourite/{word}/{translate}', 'FavouriteController@store')->name('add-favorite');
                Route::delete('/favourite/{id}', 'FavouriteController@destroy')->name('delete-favorite');

                Route::post('/result/{asset}', 'TestController@result');
                Route::post('/complete/{asset}', 'TestController@complete');

                Route::resource('/card', 'CardsController', ['except' => []]);

                Route::get('/translate', 'WordController@search');
                Route::resource('/word', 'WordController', ['except' => ['delete', 'update']]);
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
                Route::get('/assets', 'AssetsController@index');
                Route::post('/forvo/{id}', 'AssetsController@findAudio');
                Route::get('/asset/{id}', 'AssetsController@showAsset');
                Route::get('/values/{id}', 'AssetsController@showValues');
                Route::get('/examples/{id}', 'AssetsController@showExamples');
                Route::post('/asset/{id}', 'AssetsController@changeAsset');
                Route::post('/changeUsedTranslate', 'AssetsController@changeUsedTranslate');
                Route::post('/translate', 'AssetsController@editTranslate');
                Route::post('/audio', 'AssetsController@uploadAudio');
                Route::get('/sentences', 'AssetsController@getSentences');

                Route::post('/card', 'CardsController@addWordToAsset'); //TODO: frontend route!
                Route::post('/level', 'AssetsController@addBasicAssetLevel');
                Route::delete('/translate/{id}', 'AssetsController@deleteTranslate');

                Route::post('/wordfile', 'AssetsController@uploadSentences');
                Route::post('/card', 'AssetsController@addPair');
            }
        );

        parent::boot();
    }
}
