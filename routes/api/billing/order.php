<?php

use App\Http\Controllers\Billing\OrderController;

Route::group(
    [
        'as' => 'order:',
        'namespace' => 'App\Http\Controllers\Billing',
    ],
    function () {
        Route::get('/order',         [OrderController::class, 'index'])->name('all');
        Route::get('/order/{id}',    [OrderController::class, 'show'])->name('show');
        Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('delete');
        Route::post('/order',        [OrderController::class, 'store'])->name('create');
        Route::put('/order/{id}',    [OrderController::class, 'update'])->name('update');
    });