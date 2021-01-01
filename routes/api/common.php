<?php

use Illuminate\Support\Facades\Route;

Route::get('/{language}/state', 'App\Http\Controllers\Sub\Frontend\IndexController@state')->name('state');
Route::get('/me', 'App\Http\Controllers\Sub\Frontend\IndexController@getUser')->name('user-info');
Route::get('/info', 'App\Http\Controllers\Sub\Frontend\IndexController@getInfo')->name('site-info');

Route::post('/feedback',
    'App\Http\Controllers\Sub\Frontend\IndexController@feedback')->name('subdomain-feedback')->middleware(['addUserName']);

Route::get('/{language}/read', 'App\Http\Controllers\Reader\ReaderController@index')
    ->name('read')->middleware('file');

Route::get('/{language}/dashboard', 'App\Http\Controllers\DashboardController@all');