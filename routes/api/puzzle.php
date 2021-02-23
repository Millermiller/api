<?php

use App\Http\Controllers\Puzzle\PuzzleController;

Route::group(
  [
    'as' => 'puzzle',
    'namespace' => 'App\Http\Controllers',
  ],
  function () {
      Route::get('/{language}/puzzle/all',               [PuzzleController::class, 'index'])->name('all');
      Route::post('/{language}/puzzle/user',             [PuzzleController::class, 'byUser'])->name('user');
      Route::post('/{language}/puzzle/{puzzle}',         [PuzzleController::class, 'show'])->name('show');
      Route::put('/{language}/puzzle/{puzzle}/complete', [PuzzleController::class, 'complete'])->name('complete');
      Route::post('/{language}/puzzle',                  [PuzzleController::class, 'store'])->name('store');
      Route::delete('/puzzle/{puzzle}',                  [PuzzleController::class, 'destroy'])->name('destroy');
  }
);