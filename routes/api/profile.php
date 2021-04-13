<?php

use App\Http\Controllers\ProfileController;

Route::group(
  [
    'as' => 'profile',
    'namespace' => 'App\Http\Controllers',
  ],
  function () {
      Route::get('/profile/log',            [ProfileController::class, 'log'])->name('log');
      Route::post('/profile/photo',         [ProfileController::class, 'uploadImage'])->name('upload');
      Route::post('/profile/settings',      [ProfileController::class, 'edit'])->name('update');
  }
);