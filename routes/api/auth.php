<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;

Route::post('/login', LoginController::class)->name('auth::login');

Route::post('/logout', LogoutController::class)->name('auth::logout')->middleware('auth:api');

Route::post('/signup', SignupController::class)->name('auth::registration');

Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')
     ->name('auth::restore');


Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')
     ->name('auth::password.reset');