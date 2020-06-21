<?php


Route::get('/words', 'IndexController@getWords')->name('words');
Route::get('/{language}/personal', 'IndexController@getPersonal')->name('personal');

Route::get('/assetInfo/{id}', 'AssetController@assetInfo');

Route::get('/{language}/asset/{asset}', 'AssetController@show');
Route::post('/{language}/asset', 'AssetController@store');
Route::put('/{language}/asset/{asset}', 'AssetController@update');
Route::delete('/{language}/asset/{asset}', 'AssetController@destroy');

Route::post('/{language}/favourite/{word}/{translate}', 'FavouriteController@store')->name('add-favorite');
Route::delete('/{language}/favourite/{id}', 'FavouriteController@destroy')->name('delete-favorite');

Route::post('/result/{asset}', 'TestController@result');
Route::post('/complete/{asset}', 'TestController@complete');

Route::post('/card/{word}/{translate}/{asset}', 'CardsController@store')->name('add-card-to-asset');
Route::delete('/{language}/card/{card}', 'CardsController@destroy')->name('delete-card-from-asset');

Route::get('/{language}/translate', 'WordController@search');
Route::resource('/word', 'WordController', ['except' => ['delete', 'update']]);
