<?php

use App\Http\Controllers\Learn\TestController;

Route::group(
  [
    'as'         => 'test:',
    'namespace'  => 'App\Http\Controllers\Learn',
    'middleware' => ['auth:api'],
  ],
  function () {
      Route::post('/complete/{id}', [TestController::class, 'complete'])->name('complete');
      Route::get('/{language}/test', [TestController::class, 'getAllPassing'])->name('all');
      Route::delete('/test/{id}', [TestController::class, 'destroyPassing'])->name('delete');
      Route::put('/test/{id}', [TestController::class, 'updatePassing'])->name('update');
  }
);