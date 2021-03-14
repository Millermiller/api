<?php

use App\Http\Controllers\Learn\FavouriteController;

Route::group( [
  'as' => 'favourite:',
  'namespace' => 'App\Http\Controllers\Learn',
],  function () {
    Route::post('/favourite/{card}',   [FavouriteController::class, 'store'])->name('add');
    Route::delete('/favourite/{card}', [FavouriteController::class, 'destroy'])->name('remove');
});