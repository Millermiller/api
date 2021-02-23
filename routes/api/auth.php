<?php

//use Illuminate\Support\Facades\Route;

Route::post('/login', 'App\Http\Controllers\Auth\AuthController@login')
     ->name('auth::login');

Route::post('/logout', 'App\Http\Controllers\Auth\AuthController@logout')
     ->name('auth::logout')
     ->middleware('auth:api');

Route::get('/me', function (Request $request) {
    return auth()->user();
})->middleware(['auth:api'])->name('auth::me');

Route::post('/signup', 'App\Http\Controllers\Auth\RegistrationController@handle')
     ->name('auth::registration');

Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')
     ->name('auth::restore');

Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')
     ->name('auth::password.reset.form');

Route::get('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')
     ->name('auth::password.request');

Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')
     ->name('auth::password.reset');