<?php

namespace Scandinaver\Learn\Application;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider
 * @package Scandinaver\Learn\Application
 */
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
                'middleware' => ['web', 'checkDomain', 'touchUser', 'checkPlan'],
                'as' => 'sub_frontend::'
            ],
            function () {
                Route::get('/words', 'Sub\Frontend\IndexController@getWords')->name('words');
                Route::get('/personal', 'Sub\Frontend\IndexController@getPersonal')->name('personal');

                Route::get('/assetInfo/{id}', 'Sub\Frontend\AssetController@assetInfo');
                
                Route::get('/{language}/asset/{asset}', 'Sub\Frontend\AssetController@show');
                Route::post('/{language}/asset', 'Sub\Frontend\AssetController@store');
                Route::put('/{language}/asset/{asset}', 'Sub\Frontend\AssetController@update');
                Route::delete('/{language}/asset/{asset}', 'Sub\Frontend\AssetController@destroy');

                Route::post('/favourite/{word}/{translate}', 'Sub\Frontend\FavouriteController@store')->name('add-favorite');
                Route::delete('/favourite/{id}',             'Sub\Frontend\FavouriteController@destroy')->name('delete-favorite');

                Route::post('/result/{asset}', 'Sub\Frontend\TestController@result');
                Route::post('/complete/{asset}', 'Sub\Frontend\TestController@complete');

                Route::post('/card/{word}/{translate}/{asset}', 'CardsController@store')->name('add-card-to-asset');
                Route::delete('/card/{card}', 'CardsController@destroy')->name('delete-card-from-asset');

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
                Route::get('/wordscount', 'DashboardController@wordscount');
                Route::get('/assetscount', 'DashboardController@assetscount');
                Route::get('/audiocount', 'DashboardController@audiocount');
                Route::get('/textscount', 'DashboardController@textscount');

                Route::get('/assets', 'AssetsController@index');
                Route::post('/forvo/{id}', 'AssetsController@findAudio');
                Route::get('/asset/{id}', 'AssetsController@showAsset');
                Route::get('/values/{id}', 'AssetsController@showValues');
                Route::get('/examples/{id}', 'AssetsController@showExamples');
                Route::post('/asset/{id}', 'AssetsController@changeAsset');
                Route::post('/changeUsedTranslate', 'AssetsController@changeUsedTranslate');
                Route::post('/translate', 'AssetsController@editTranslate');
                Route::post('/audio', 'AssetsController@uploadAudio');

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
