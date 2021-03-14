<?php

use App\Http\Controllers\Puzzle\PuzzleController;

Route::group(
  [
    'as' => 'puzzle',
    'namespace' => 'App\Http\Controllers',
  ],
  function () {
      Route::get('/puzzle',                              [PuzzleController::class, 'index'])->name('all');
      Route::get('/puzzle/user',                         [PuzzleController::class, 'byUser'])->name('user');
      Route::get('/puzzle/{id}',                         [PuzzleController::class, 'show'])->name('show');
      Route::put('/puzzle/{id}/complete',                [PuzzleController::class, 'complete'])->name('complete');
      Route::post('/{language}/puzzle',                  [PuzzleController::class, 'store'])->name('store');
      Route::delete('/puzzle/{id}',                      [PuzzleController::class, 'destroy'])->name('destroy');
  }
);