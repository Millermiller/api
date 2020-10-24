<?php

Route::get('/intro', 'App\Http\Controllers\Common\IntroController@index')->name('intro:all');
Route::get('/intro/{introId}', 'App\Http\Controllers\Common\IntroController@show')->name('intro:show');
Route::delete('/intro/{introId}', 'App\Http\Controllers\Common\IntroController@destroy')->name('intro:destroy');
Route::post('/intro', 'App\Http\Controllers\Common\IntroController@store')->name('intro:create');
Route::put('/intro/{introId}', 'App\Http\Controllers\Common\IntroController@update')->name('intro:update');