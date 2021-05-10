<?php


use App\Http\Controllers\Common\LanguageController;

Route::get('/language',         [LanguageController::class,   'index'])->name('languages:all')->withoutMiddleware(['auth:api']);
Route::post('/language',        [LanguageController::class,   'store'])->name('languages:create');
Route::post('/language/{id}',   [LanguageController::class,  'update'])->name('languages:update');
Route::delete('/language/{id}', [LanguageController::class, 'destroy'])->name('languages:destroy');