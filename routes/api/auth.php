<?php

//use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegistrationController;

Route::post('/login', [AuthController::class, 'login'])
     ->name('auth::login');

Route::post('/logout', [AuthController::class, 'logout'])
     ->name('auth::logout')
     ->middleware('auth:api');



Route::post('/signup', [RegistrationController::class, 'handle'])
     ->name('auth::registration');

Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')
     ->name('auth::restore');

Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')
     ->name('auth::password.reset.form');

Route::get('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')
     ->name('auth::password.request');

Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')
     ->name('auth::password.reset');