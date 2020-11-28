<?php

Route::post('/{language}/card/create/{word}/{translate}', 'App\Http\Controllers\Learn\CardController@create')->name('create-card');
Route::post('/{language}/card/{card}/{asset}', 'App\Http\Controllers\Learn\CardController@store')->name('add-card-to-asset');
Route::delete('/{language}/card/{card}/{asset}', 'App\Http\Controllers\Learn\CardController@destroy')->name('delete-card-from-asset');
Route::get('/{language}/translate', 'App\Http\Controllers\Learn\CardController@search');
Route::put('/card/{card}', 'App\Http\Controllers\Learn\CardController@update');
Route::post('/{language}/wordfile', 'App\Http\Controllers\Learn\CardController@uploadSentences');