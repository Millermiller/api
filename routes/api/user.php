<?php

use App\Http\Controllers\User\UserController;

Route::group(
    [
        'as' => 'user:',
        'namespace' => 'App\Http\Controllers\User',
    ],
    function () {
        Route::get('/user',         [UserController::class, 'index'])->name('all');
        Route::get('/user/{id}',    [UserController::class, 'show'])->name('show');
        Route::get('/user/search',  [UserController::class, 'search'])->name('search');

        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('delete');
        Route::post('/user',        [UserController::class, 'store'])->name('create');
        Route::put('/user/{id}',    [UserController::class, 'update'])->name('update');
    }
);