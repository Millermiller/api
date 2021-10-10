<?php

use App\Http\Controllers\Billing\PaymentController;

Route::group(
    [
        'as' => 'payment:',
        'namespace' => 'App\Http\Controllers\Billing',
    ],
    function () {
        Route::get('/payment',              [PaymentController::class, 'index'])->name('all');
        Route::get('/payment/{id}',         [PaymentController::class, 'show'])->name('show');
        Route::delete('/payment/{id}',      [PaymentController::class, 'destroy'])->name('delete');
        Route::post('/payment',             [PaymentController::class, 'store'])->name('create');
        Route::put('/payment/{id}',         [PaymentController::class, 'update'])->name('update');
    });