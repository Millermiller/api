<?php

Route::get('/articles/search', 'ArticleController@search')->name('search');
Route::post('/articles/upload', 'ArticleController@upload')->name('upload');
Route::resource('/articles', 'ArticleController',
    ['except' => ['create', 'edit']]
);

Route::resource('/categories', 'CategoryController',
    ['except' => ['edit', 'create']]
);

Route::get('/comments/search', 'CommentController@search')->name('search');
Route::resource('/comments', 'CommentController',
    ['except' => ['edit', 'create']]
);

Route::resource('/meta', 'MetaController',
    ['except' => ['edit', 'create']]
);

Route::resource('/plan', 'PlanController');

Route::post('/send', 'VueController@testmail');

Route::get('/dashboard', 'DashboardController@all');

Route::get('/users/search', 'UsersController@search')->name('search');
Route::resource('/users', 'UsersController',
    ['except' => ['create', 'edit']]
);

Route::resource('/log', 'LogController', ['except' => ['edit', 'create']]);
Route::resource('/message', 'MessageController', ['except' => ['edit', 'create']]);
Route::post('/message/read/{id}', 'DashboardController@readMessage');

Route::resource('/intro', 'IntroController');

Route::get('/wordscount', 'DashboardController@wordscount');
Route::get('/assetscount', 'DashboardController@assetscount');
Route::get('/audiocount', 'DashboardController@audiocount');
Route::get('/textscount', 'DashboardController@textscount');

Route::get(' /{language}/assets', 'AssetsController@index');
Route::post('/forvo/{id}', 'AssetsController@findAudio');
Route::get('/asset/{asset}', 'AssetsController@showAsset');
Route::get('/{language}/values/{word}', 'AssetsController@showValues');
Route::get('/{language}/examples/{card}', 'AssetsController@showExamples');
Route::post('/asset/{id}', 'AssetsController@changeAsset');
Route::post('/changeUsedTranslate', 'AssetsController@changeUsedTranslate');
Route::post('/translate', 'AssetsController@editTranslate');
Route::post('/audio', 'AssetsController@uploadAudio');

Route::post('/card', 'CardsController@addWordToAsset'); //TODO: frontend route!
Route::post('/level', 'AssetsController@addBasicAssetLevel');
Route::delete('/translate/{id}', 'AssetsController@deleteTranslate');

Route::post('/wordfile', 'AssetsController@uploadSentences');
Route::post('/card', 'AssetsController@addPair');

Route::resource('/puzzle', 'PuzzleController');

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