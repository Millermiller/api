<?php

use App\Http\Controllers\RBAC\RoleController;

Route::group(
    [
        'as' => 'role:',
        'namespace' => 'App\Http\Controllers\RBAC',
        'middleware' => ['auth:api'],
    ],
    function () {
        Route::get('/role',         [RoleController::class, 'index'])->name('all');
        Route::get('/role/{id}',    [RoleController::class, 'show'])->name('show');
        Route::get('/role/search',  [RoleController::class, 'search'])->name('search');
        Route::post('/role/{roleId}/{permissionId}', [RoleController::class, 'attachPermission'])->name('attachPermission');
        Route::delete('/role/{roleId}/{permissionId}', [RoleController::class, 'detachPermission'])->name('detachPermission');
        Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('delete');
        Route::post('/role',        [RoleController::class, 'store'])->name('create');
        Route::put('/role/{id}',    [RoleController::class, 'update'])->name('update');
    }
);