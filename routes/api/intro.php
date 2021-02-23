<?php


use App\Http\Controllers\Common\IntroController;

Route::group(
  [
      'as' => 'intro:',
      'namespace' => 'App\Http\Controllers\Learn',
  ],
  function () {
    Route::get('/intro',              [IntroController::class, 'index'])->name('all');
    Route::get('/intro/{introId}',    [IntroController::class, 'show'])->name('show');
    Route::delete('/intro/{introId}', [IntroController::class, 'destroy'])->name('delete');
    Route::post('/intro',             [IntroController::class, 'store'])->name('create');
    Route::put('/intro/{introId}',    [IntroController::class, 'update'])->name('update');
});