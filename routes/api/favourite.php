<?php

use App\Http\Controllers\Learn\FavouriteController;

Route::group( [
  'as' => 'favourite:',
  'namespace' => 'App\Http\Controllers\Learn',
],  function () {
    Route::post('/{language}/favourite/{card}',   [FavouriteController::class, 'store'])->name('add');
    Route::delete('/{language}/favourite/{card}', [FavouriteController::class, 'destroy'])->name('remove');
});