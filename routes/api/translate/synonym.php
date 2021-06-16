<?php

use App\Http\Controllers\Translate\SynonymController;

Route::group(
    [
        'as'        => 'synonym',
        'namespace' => 'App\Http\Controllers\RBAC',
    ],
    function () {
        Route::get('/synonym/{id}',       [SynonymController::class, 'show'])->name('show');
        Route::get('/synonym/word/{id}',  [SynonymController::class, 'getByWord'])->name('word');
        Route::post('/synonym',           [SynonymController::class, 'store'])->name('create');
        Route::delete('/synonym/{id}',    [SynonymController::class, 'destroy'])->name('delete');
    }
);