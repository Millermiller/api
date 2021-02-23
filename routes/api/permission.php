<?php

use App\Http\Controllers\RBAC\PermissionController;

Route::group(
    [
        'as' => 'permission:',
        'namespace' => 'App\Http\Controllers\RBAC',
    ],
    function () {
        Route::get('/permission',         [PermissionController::class, 'index'])->name('all');
        Route::get('/permission/{id}',    [PermissionController::class, 'show'])->name('show');
        Route::get('/permission/search',  [PermissionController::class, 'search'])->name('search');
        Route::delete('/permission/{id}', [PermissionController::class, 'destroy'])->name('delete');
        Route::post('/permission',        [PermissionController::class, 'store'])->name('create');
        Route::put('/permission/{id}',    [PermissionController::class, 'update'])->name('update');
    }
);