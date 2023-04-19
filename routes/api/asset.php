<?php

use App\Http\Controllers\Learn\AssetController;

Route::group(
  [
    'as'         => 'asset:',
    'namespace'  => 'App\Http\Controllers\Learn',
  ],
  function () {
      Route::get('/asset',                       [AssetController::class, 'index'])->name('all');

      Route::get('/asset/{id}',                  [AssetController::class, 'show'])->name('show');
      Route::post('/asset',                      [AssetController::class, 'store'])->name('store');
      Route::put('/asset/{id}',                  [AssetController::class, 'update'])->name('update');
      Route::delete('/asset/{id}',               [AssetController::class, 'destroy'])->name('destroy');

      Route::post('/asset/{asset}/{card}',       [AssetController::class, 'addCard'])->name('card:add');
      Route::delete('/asset/{asset}/{card}',     [AssetController::class, 'removeCard'])->name('card:remove');

      Route::post('/forvo/{id}',                 [AssetController::class, 'findAudio'])->name('forvo');//TODO: remove

      Route::get('/values/{word}',               [AssetController::class, 'showValues'])->name('values:show');

      Route::get('/examples/{card}',             [AssetController::class, 'showExamples'])->name('examples');

      Route::post('/translate',                  [AssetController::class, 'editTranslate'])->name('translate:edit');

      Route::post('/audio',                      [AssetController::class, 'uploadAudio'])->name('audio:upload');

      Route::get('/personal',                    [AssetController::class, 'testGetPersonalAssets'])->name('personal');

      Route::post('/card',                       [AssetController::class, 'addPair'])->name('pair:create');//TODO: remove

      Route::get('/{language}/assets-mobile',    [AssetController::class, 'assetsMobile'])->name('mobile');//TODO: refactor
  }
);