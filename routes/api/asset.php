<?php

use App\Http\Controllers\Learn\AssetController;

Route::group(
  [
    'as'         => 'asset:',
    'namespace'  => 'App\Http\Controllers\Learn',
  ],
  function () {
      Route::get('/asset/{id}',                  [AssetController::class, 'show'])->name('show');//TODO: refactor

      Route::post('/asset',                      [AssetController::class, 'store'])->name('store');

      Route::put('/asset/{id}',                  [AssetController::class, 'update'])->name('update');

      Route::post('/asset/{asset}/{card}',       [AssetController::class, 'addCard'])->name('card:add');

      Route::delete('/asset/{asset}/{card}',     [AssetController::class, 'removeCard'])->name('card:remove');

      Route::delete('/asset/{id}',               [AssetController::class, 'destroy'])->name('destroy');

      Route::post('/{language}/level',           [AssetController::class, 'addBasicAssetLevel'])->name('add:basic');

      Route::get(' /{language}/assets',          [AssetController::class, 'index'])->name('all');

      Route::get(' /{language}/cards/sentence',  [AssetController::class, 'getAllSentences'])->name('sentence:all'); //TODO: remove

      Route::post('/forvo/{id}',                 [AssetController::class, 'findAudio'])->name('forvo');//TODO: remove

      Route::get('/asset/{asset}',               [AssetController::class, 'showAsset']);//TODO: refactor

      Route::get('/{language}/values/{word}',    [AssetController::class, 'showValues'])->name('values:show');

      Route::get('/{language}/examples/{card}',  [AssetController::class, 'showExamples'])->name('examples');

      Route::post('/changeUsedTranslate',        [AssetController::class, 'changeUsedTranslate'])->name('change:translate');//TODO: remove

      Route::post('/translate',                  [AssetController::class, 'editTranslate'])->name('translate:edit');

      Route::post('/audio',                      [AssetController::class, 'uploadAudio'])->name('audio:upload');

      Route::get('/{language}/words',            [AssetController::class, 'getWords'])->name('words');

      Route::get('/{language}/sentences',        [AssetController::class, 'getSentences'])->name('sentences');

      Route::get('/personal',                    [AssetController::class, 'getPersonal'])->name('personal');

      Route::post('/card',                       [AssetController::class, 'addPair'])->name('pair:create');//TODO: remove

      Route::get('/{language}/assets-mobile',    [AssetController::class, 'assetsMobile'])->name('mobile');//TODO: refactor
  }
);