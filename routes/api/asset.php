<?php



Route::get('/{language}/asset/{asset}', 'App\Http\Controllers\Learn\AssetController@show')->name('asset.show');
Route::post('/{language}/asset',        'App\Http\Controllers\Learn\AssetController@store')->name('asset.store');
Route::put('/{language}/asset/{asset}', 'App\Http\Controllers\Learn\AssetController@update')->name('asset.update');
Route::delete('/{language}/asset/{asset}', 'App\Http\Controllers\Learn\AssetController@destroy')->name('asset.destroy');
Route::post('/{language}/level', 'App\Http\Controllers\Learn\AssetController@addBasicAssetLevel');
Route::get(' /{language}/assets', 'App\Http\Controllers\Learn\AssetController@index')->name('asset:all');
Route::get(' /{language}/cards/sentence', 'App\Http\Controllers\Learn\AssetController@getAllSentences');
Route::post('/forvo/{id}', 'App\Http\Controllers\Learn\AssetController@findAudio');
Route::get('/asset/{asset}', 'App\Http\Controllers\Learn\AssetController@showAsset');
Route::get('/{language}/values/{word}', 'App\Http\Controllers\Learn\AssetController@showValues');
Route::get('/{language}/examples/{card}', 'App\Http\Controllers\Learn\AssetController@showExamples');
Route::put('/asset/{asset}', 'App\Http\Controllers\Learn\AssetController@changeAsset');
Route::post('/changeUsedTranslate', 'App\Http\Controllers\Learn\AssetController@changeUsedTranslate');
Route::post('/translate', 'App\Http\Controllers\Learn\AssetController@editTranslate');
Route::post('/audio', 'App\Http\Controllers\Learn\AssetController@uploadAudio');
Route::get('/{language}/words', 'App\Http\Controllers\Learn\AssetController@getWords')->name('words');
Route::get('/{language}/sentences', 'App\Http\Controllers\Learn\AssetController@getSentences')->name('sentences');
Route::get('/{language}/personal',       'App\Http\Controllers\Learn\AssetController@getPersonal')->name('personal');
Route::post('/card', 'App\Http\Controllers\Learn\AssetController@addPair');
Route::get('/{language}/assets-mobile', 'App\Http\Controllers\Learn\AssetController@assetsMobile')
    ->middleware(['auth:api'])
    ->name('asset-mobile');