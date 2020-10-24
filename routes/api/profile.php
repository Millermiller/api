<?php

Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->name('profile');
Route::get('/profile/settings', 'App\Http\Controllers\ProfileController@settings')->name('profile-settings');
Route::get('/profile/log', 'App\Http\Controllers\ProfileController@log')->name('profile-log');
Route::post('/profile/uploadImage', 'App\Http\Controllers\ProfileController@uploadImage');
Route::post('/profile/update', 'App\Http\Controllers\ProfileController@edit')->name('profile-update');