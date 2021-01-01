<?php

Route::get('/user/search', 'App\Http\Controllers\User\UserController@search')->name('search');
Route::resource('/user', 'App\Http\Controllers\User\UserController',
    ['except' => ['create', 'edit']]
);
