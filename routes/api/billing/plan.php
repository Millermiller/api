<?php

use App\Http\Controllers\Billing\PlanController;

Route::group(
    [
        'as' => 'plan:',
        'namespace' => 'App\Http\Controllers\Billing',
    ],
    function () {
        Route::get('/plan',              [PlanController::class, 'index'])->name('all');
        Route::get('/plan/{id}',         [PlanController::class, 'show'])->name('show');
        Route::delete('/plan/{id}',      [PlanController::class, 'destroy'])->name('delete');
        Route::post('/plan',             [PlanController::class, 'store'])->name('create');
        Route::put('/plan/{id}',         [PlanController::class, 'update'])->name('update');
    });
