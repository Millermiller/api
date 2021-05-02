<?php

use App\Http\Controllers\Settings\SettingsController;

Route::group(
    [
        'as' => 'settings:',
        'namespace' => 'App\Http\Controllers\Settings',
        'middleware' => ['auth:api'],
    ],
    function () {
        Route::get('/setting',         [SettingsController::class, 'index'])->name('all');
        Route::get('/setting/{id}',    [SettingsController::class, 'show'])->name('show');
        Route::delete('/setting/{id}', [SettingsController::class, 'destroy'])->name('delete');
        Route::post('/setting',        [SettingsController::class, 'store'])->name('create');
        Route::post('/setting/{id}',   [SettingsController::class, 'setValue'])->name('set:value');
        Route::put('/setting/{id}',    [SettingsController::class, 'update'])->name('update');
        Route::put('/setting',         [SettingsController::class, 'bulkSetValue'])->name('bulk:set:value');
    }
);
