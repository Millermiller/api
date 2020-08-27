<?php
use Illuminate\Support\Facades\Route;
Route::get('/{language}/words', 'App\Http\Controllers\Sub\Frontend\IndexController@getWords')->name('words');
Route::get('/{language}/sentences', 'App\Http\Controllers\Sub\Frontend\IndexController@getSentences')->name('sentences');
Route::get('/{language}/personal',       'App\Http\Controllers\Sub\Frontend\IndexController@getPersonal')->name('personal');
Route::get('/{language}/assetInfo/{id}', 'App\Http\Controllers\Sub\Frontend\AssetController@assetInfo');

Route::get('/{language}/asset/{asset}', 'App\Http\Controllers\Sub\Frontend\AssetController@show')->name('asset.show');
Route::post('/{language}/asset',        'App\Http\Controllers\Sub\Frontend\AssetController@store')->name('asset.store');
Route::put('/{language}/asset/{asset}', 'App\Http\Controllers\Sub\Frontend\AssetController@update')->name('asset.update');
Route::delete('/{language}/asset/{asset}', 'App\Http\Controllers\Sub\Frontend\AssetController@destroy')->name('asset.destroy');

Route::post('/{language}/favourite/{card}', 'App\Http\Controllers\Sub\Frontend\FavouriteController@store')->name('add-favorite');
Route::delete('/{language}/favourite/{card}', 'App\Http\Controllers\Sub\Frontend\FavouriteController@destroy')->name('delete-favorite');

Route::post('/result/{asset}', 'App\Http\Controllers\Sub\Frontend\TestController@result');
Route::post('/complete/{asset}', 'App\Http\Controllers\Sub\Frontend\TestController@complete');

Route::post('/{language}/card/create/{word}/{translate}', 'App\Http\Controllers\Sub\Frontend\CardsController@create')->name('create-card');
Route::post('/{language}/card/{card}/{asset}', 'App\Http\Controllers\Sub\Frontend\CardsController@store')->name('add-card-to-asset');
Route::delete('/{language}/card/{card}/{asset}', 'App\Http\Controllers\Sub\Frontend\CardsController@destroy')->name('delete-card-from-asset');

Route::get('/{language}/translate', 'App\Http\Controllers\Sub\Frontend\WordController@search');
Route::resource('/{language}/word', 'App\Http\Controllers\Sub\Frontend\WordController', ['except' => ['delete', 'update']]);
