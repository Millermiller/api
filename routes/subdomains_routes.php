<?php

/**
 * Created by PhpStorm.
 * User: john
 * Date: 27.09.2018
 * Time: 23:24
 */

/***************************** SUBDOMAIN - PUBLIC **********************************/

Route::group([
    'domain' => '{subdomain}.' . config('app.DOMAIN'),
], function () {
    Route::get('/login', 'Sub\Frontend\IndexController@index')->middleware('guest');
    Route::post('/login', 'Auth\LoginSubController@login')->middleware('checkDomain');
});

Route::group([
    'domain' => '{subdomain}.' . config('app.DOMAIN'),
    'middleware' => ['checkDomain', 'touchUser', 'checkPlan'],
    'namespace' => 'Sub\Frontend',
    'as' => 'sub_frontend::'
], function () {
    Route::post('/logout', 'LogoutController@index');

    Route::get('/', 'IndexController@index');

    Route::get('/check', 'IndexController@check');
    Route::get('/state', 'IndexController@getState');
    Route::get('/user', 'IndexController@getUser');
    Route::get('/info', 'IndexController@getInfo');

    Route::get('/words', 'IndexController@getWords');
    Route::get('/sentences', 'IndexController@getSentences');

    Route::get('/personal', 'IndexController@getPersonal');
    Route::get('/userassets', 'IndexController@getUserAssets');
    Route::post('/feedback', 'IndexController@feedback');
    Route::get('/asset/{id}', 'LearnController@getAsset');
    Route::get('/assetInfo/{id}', 'LearnController@assetInfo');

    Route::get('/favourites', 'FavouriteController@getFavourites');
    Route::post('/favourite', 'FavouriteController@addToFavourite');
    Route::delete('/favourite/{id}', 'FavouriteController@deleteFavourite');

    Route::post('/saveTestResult', 'TestController@saveTestResult');
    Route::post('/nextLevel', 'TestController@nextLevel');
    Route::delete('/asset/{id}', 'CardsController@deleteAsset');
    Route::post('/asset', 'CardsController@createAsset');
    Route::get('/cards/{id}', 'CardsController@showAsset');
    Route::delete('/card/{id}/{asset_id}', 'CardsController@deleteWordFromAsset');
    Route::get('/translate', 'CardsController@getTranslate');
    Route::post('/card', 'CardsController@addWordToAsset');
    Route::post('/createCard', 'CardsController@createCard');
    Route::get('/text/{id}', 'TextController@getText');
    Route::get('/syns/{id}', 'TextController@getSyns');
    Route::post('/nextTLevel', 'TextController@nextLevel');

    Route::resource('/puzzle', 'PuzzleController', ['except' => ['create', 'delete']]);
});

/******************************** SUBDOMAIN - ADMIN ***********************************/

Route::group([
    'domain' => '{subdomain}.' . config('app.DOMAIN'),
    'middleware' => ['checkDomain'],
], function () {
    Route::get('/admin/login', 'Auth\LoginAdminController@showLoginForm');
    Route::post('/admin/login', 'Auth\LoginAdminController@login');
});

Route::group([
    'domain' => '{subdomain}.' . config('app.DOMAIN'),
    'middleware' => ['checkAdmin', 'checkDomain', 'touchUser'],
    'namespace' => 'Sub\Backend',
    'prefix' => 'admin'
], function () {

    Route::get('/', 'VueController@index');


    Route::get('/logout', 'VueController@logout');

    Route::get('/dashboard', 'DashboardController@index');
    Route::delete('/log/{id}', 'DashboardController@deleteLog');
    Route::delete('/message/{id}', 'DashboardController@deleteMessage');
    Route::post('/message/read/{id}', 'DashboardController@readMessage');

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

    Route::resource('/puzzle', 'PuzzleController');
    Route::resource('/intro', 'IntroController');
});
