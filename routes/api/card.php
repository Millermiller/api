<?php

use App\Http\Controllers\Learn\CardController;

Route::group( [
  'as' => 'card:',
  'namespace' => 'App\Http\Controllers\Learn',
],  function () {
    Route::post('/{language}/card/create/{word}/{translate}', [CardController::class, 'create'])->name('create');
    Route::get('/card/search',                                [CardController::class, 'search'])->name('search');
    Route::put('/card/{card}',                                [CardController::class, 'update'])->name('update');
    Route::post('/{language}/wordfile',                       [CardController::class, 'uploadSentences'])->name('upload');
});