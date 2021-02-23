<?php

use App\Http\Controllers\Translate\TextController;

Route::group(
  [
    'as' => 'text',
    'namespace' => 'App\Http\Controllers\RBAC',
  ],
  function () {
      Route::get('/{language}/text/{text}',         [TextController::class, 'show'])->name('show');
      Route::get('/{language}/texts', [TextController::class, 'all'])->name('all');
      Route::post('/{language}/nextTLevel',  [TextController::class, 'nextLevel']);
      Route::post('/text/publish', [TextController::class, 'publish'])->name('publish');
      Route::post('/text/{id}', [TextController::class, 'update'])->name('update');
      Route::post('/text', [TextController::class, 'store'])->name('create');
      Route::delete('/text/{id}', [TextController::class, 'destroy'])->name('delete');
      /********************** TODO:refactor **************************/
      Route::post('/text/extra', [TextController::class, 'addExtras']);
      Route::post('/text/sentences',  [TextController::class, 'saveSentences']);
      Route::get('/text/synonyms/{id}', [TextController::class, 'getSynonyms']);
      Route::post('/text/synonym', [TextController::class, 'addSynonym']);
      Route::delete('/text/synonym/{id}', [TextController::class, 'deleteSynonym']);
      Route::post('/text/image/{id}', [TextController::class, 'uploadImage']);
      Route::post('/text/description/{id}', [TextController::class, 'updateDescription']);
  }
);