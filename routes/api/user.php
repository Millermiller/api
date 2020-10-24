<?php

Route::get('/users/search', 'App\Http\Controllers\User\UserController@search')->name('search');
Route::resource('/users', 'App\Http\Controllers\User\UserController',
    ['except' => ['create', 'edit']]
);
