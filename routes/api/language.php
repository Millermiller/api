<?php


use App\Http\Controllers\Common\LanguageController;

Route::get('/languages', [LanguageController::class, 'index'])->name('languages:all');