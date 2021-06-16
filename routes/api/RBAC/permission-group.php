<?php

use App\Http\Controllers\RBAC\PermissionGroupController;

Route::group(
    [
        'as' => 'permission:group:',
        'namespace' => 'App\Http\Controllers\RBAC',
    ],
    function () {
        Route::get('/permission-group',         [PermissionGroupController::class, 'index'])->name('all');
        Route::get('/permission-group/{id}',    [PermissionGroupController::class, 'show'])->name('show');
        Route::get('/permission-group/search',  [PermissionGroupController::class, 'search'])->name('search');
        Route::delete('/permission-group/{id}', [PermissionGroupController::class, 'destroy'])->name('delete');
        Route::post('/permission-group',        [PermissionGroupController::class, 'store'])->name('create');
        Route::put('/permission-group/{id}',    [PermissionGroupController::class, 'update'])->name('update');
    }
);