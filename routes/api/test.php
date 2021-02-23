<?php

use App\Http\Controllers\Learn\TestController;

Route::group(
  [
    'as'         => 'test:',
    'namespace'  => 'App\Http\Controllers\Learn',
    'middleware' => ['auth:api'],
  ],
  function () {
      Route::post('/{language}/complete/{id}', [TestController::class, 'complete'])->name('complete');
  }
);