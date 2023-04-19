<?php

use App\Http\Controllers\Statistic\StatisticController;

Route::group(
    [
        'as' => 'settings:',
        'namespace' => 'App\Http\Controllers\Statistic',
        'middleware' => ['auth:api'],
    ],
    function () {
        Route::get('/statistic',         [StatisticController::class, 'index'])->name('all');
        Route::get('/statistic/{id}',    [StatisticController::class, 'show'])->name('show');
        Route::post('/statistic',        [StatisticController::class, 'store'])->name('create');
        Route::put('/statistic/{id}',    [StatisticController::class, 'update'])->name('update');
        Route::delete('/statistic/{id}', [StatisticController::class, 'destroy'])->name('delete');
    }
);