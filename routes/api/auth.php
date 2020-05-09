<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', 'AuthController@login')
     ->name('auth::login');

Route::post('/logout', 'AuthController@logout')
     ->name('auth::logout')
     ->middleware('auth:api');

Route::get('/me', function (Request $request) {
    return auth()->user();
})->middleware(['auth:api'])->name('auth::me');

Route::post('/signup', 'RegisterController@register')
     ->name('auth::registration');

Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')
     ->name('auth::restore');

Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')
     ->name('auth::password.reset.form');

Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')
     ->name('auth::password.request');

Route::post('/password/reset', 'ResetPasswordController@reset')
     ->name('auth::password.reset');