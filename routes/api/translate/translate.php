<?php

use App\Http\Controllers\Translate\TextController;

Route::group(
    [
        'as'        => 'text',
    ],
    function () {
        Route::get('/text',                   [TextController::class, 'index'])->name('all');
        Route::get('/text/{id}',              [TextController::class, 'show'])->name('show');
        Route::put('/text/{id}',              [TextController::class, 'update'])->name('update');

        Route::post('/{language}/nextTLevel', [TextController::class, 'nextLevel']); //TODO: we need this? move language to request body
        Route::post('/text',                  [TextController::class, 'store'])->name('create');
        Route::delete('/text/{id}',           [TextController::class, 'destroy'])->name('delete');

        Route::post('/text/image/{id}',       [TextController::class, 'uploadImage']);
        Route::post('/text/description/{id}', [TextController::class, 'updateDescription']);
    }
);