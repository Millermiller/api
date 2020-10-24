<?php

Route::post('/{language}/favourite/{card}', 'App\Http\Controllers\Learn\FavouriteController@store')->name('add-favorite');
Route::delete('/{language}/favourite/{card}', 'App\Http\Controllers\Learn\FavouriteController@destroy')->name('delete-favorite');