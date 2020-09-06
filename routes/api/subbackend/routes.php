<?php

use Illuminate\Support\Facades\Route;

Route::get('/articles/search', 'App\Http\Controllers\Backend\rticleController@search')->name('search');
Route::post('/articles/upload', 'App\Http\Controllers\Backend\ArticleController@upload')->name('upload');
Route::resource('/articles', 'App\Http\Controllers\Backend\ArticleController',
    ['except' => ['create', 'edit']]
);

Route::resource('/categories', 'App\Http\Controllers\Backend\CategoryController',
    ['except' => ['edit', 'create']]
);

Route::get('/comments/search', 'App\Http\Controllers\Backend\CommentController@search')->name('search');
Route::resource('/comments', 'App\Http\Controllers\Backend\CommentController',
    ['except' => ['edit', 'create']]
);

Route::resource('/meta', 'App\Http\Controllers\Backend\MetaController',
    ['except' => ['edit', 'create']]
);

Route::resource('/plan', 'App\Http\Controllers\Backend\PlanController');

Route::post('/send', 'App\Http\Controllers\Backend\VueController@testmail');

Route::get('/dashboard', 'App\Http\Controllers\Backend\DashboardController@all');

Route::get('/users/search', 'App\Http\Controllers\Backend\UsersController@search')->name('search');
Route::resource('/users', 'App\Http\Controllers\Backend\UsersController',
    ['except' => ['create', 'edit']]
);

Route::resource('/log', 'App\Http\Controllers\Backend\LogController', ['except' => ['edit', 'create']]);
Route::resource('/message', 'App\Http\Controllers\Backend\MessageController', ['except' => ['edit', 'create']]);
Route::post('/message/read/{id}', 'App\Http\Controllers\Backend\DashboardController@readMessage');

Route::resource('/intro', 'App\Http\Controllers\Backend\IntroController');

Route::get('/wordscount', 'App\Http\Controllers\Backend\DashboardController@wordscount');
Route::get('/assetscount', 'App\Http\Controllers\Backend\DashboardController@assetscount');
Route::get('/audiocount', 'App\Http\Controllers\Backend\DashboardController@audiocount');
Route::get('/textscount', 'App\Http\Controllers\Backend\DashboardController@textscount');

Route::get(' /{language}/assets', 'App\Http\Controllers\Backend\AssetsController@index');
Route::get(' /{language}/cards/sentence', 'App\Http\Controllers\Backend\AssetsController@getSentences');
Route::post('/forvo/{id}', 'App\Http\Controllers\Backend\AssetsController@findAudio');
Route::get('/asset/{asset}', 'App\Http\Controllers\Backend\AssetsController@showAsset');
Route::get('/{language}/values/{word}', 'App\Http\Controllers\Backend\AssetsController@showValues');
Route::get('/{language}/examples/{card}', 'App\Http\Controllers\Backend\AssetsController@showExamples');
Route::post('/asset/{id}', 'App\Http\Controllers\Backend\AssetsController@changeAsset');
Route::post('/changeUsedTranslate', 'App\Http\Controllers\Backend\AssetsController@changeUsedTranslate');
Route::post('/translate', 'App\Http\Controllers\Backend\AssetsController@editTranslate');
Route::post('/audio', 'App\Http\Controllers\Backend\AssetsController@uploadAudio');

Route::post('/card', 'App\Http\Controllers\Backend\CardsController@addWordToAsset'); //TODO: frontend route!
Route::post('/level', 'App\Http\Controllers\Backend\AssetsController@addBasicAssetLevel');
Route::delete('/translate/{id}', 'App\Http\Controllers\Backend\AssetsController@deleteTranslate');

Route::post('/wordfile', 'App\Http\Controllers\Backend\AssetsController@uploadSentences');
Route::post('/card', 'App\Http\Controllers\Backend\AssetsController@addPair');

Route::resource('/puzzle', 'App\Http\Controllers\Backend\PuzzleController');

Route::get('/{language}/texts', 'App\Http\Controllers\Backend\TextController@all');
Route::post('/text/publish', 'App\Http\Controllers\Backend\TextController@publish');
Route::post('/text/{id}', 'App\Http\Controllers\Backend\TextController@textedit');
Route::post('/text', 'App\Http\Controllers\Backend\TextController@textcreate');
Route::delete('/text/{id}', 'App\Http\Controllers\Backend\TextController@textdelete');
Route::get('/text/{id}', 'App\Http\Controllers\Backend\TextController@getText');
Route::post('/text/extra', 'App\Http\Controllers\Backend\TextController@addExtras');
Route::post('/text/sentences', 'App\Http\Controllers\Backend\TextController@saveSentences');
Route::get('/text/synonyms/{id}', 'App\Http\Controllers\Backend\TextController@getSynonyms');
Route::post('/text/synonym', 'App\Http\Controllers\Backend\TextController@addSynonym');
Route::delete('/text/synonym/{id}', 'App\Http\Controllers\Backend\TextController@deleteSynonym');
Route::post('/text/image/{id}', 'App\Http\Controllers\Backend\TextController@uploadImage');
Route::post('/text/description/{id}', 'App\Http\Controllers\Backend\TextController@updateDescription');
