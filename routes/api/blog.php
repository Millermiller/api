<?php


use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Blog\CategoryController;

Route::group(
    [
        'as' => 'post:',
        'namespace' => 'App\Http\Controllers\Blog',
        'middleware' => [],
    ],
    function () {
        Route::get('/post',          [PostController::class, 'index'])->name('all');
        Route::get('/post/{postId}', [PostController::class, 'show'])->name('show');
        Route::get('/post/search',   [PostController::class, 'search'])->name('search');
    }
);

Route::group(
    [
        'as' => 'post:',
        'namespace' => 'App\Http\Controllers\Blog',
        'middleware' => ['auth:api'],
    ],
    function () {
        Route::delete('/post/{postId}', [PostController::class, 'destroy'])->name('delete');
        Route::post('/post',            [PostController::class, 'store'])->name('create');
        Route::put('/post/{postId}',    [PostController::class, 'update'])->name('update');
        Route::post('/post/upload',     [PostController::class, 'upload'])->name('upload');
    }
);

Route::group(
  [
      'as' => 'category:',
      'namespace' => 'App\Http\Controllers\Blog',
      'middleware' => ['auth:api'],
  ],
  function () {
    Route::get('/category',               [CategoryController::class, 'index'])->name('all');
    Route::get('/category/{categoryId}',  [CategoryController::class, 'show'])->name('show');
});

Route::group(
  [
      'as' => 'category:',
      'namespace' => 'App\Http\Controllers\Blog',
      'middleware' => ['auth:api'],
  ],
  function () {
    Route::delete('/category/{categoryId}', [CategoryController::class, 'destroy'])->name('delete');
    Route::post('/category',                [CategoryController::class, 'store'])->name('create');
    Route::put('/category/{categoryId}',    [CategoryController::class, 'update'])->name('update');
});

Route::group(
  [
      'as' => 'comment:',
      'namespace' => 'App\Http\Controllers\Blog',
  ],
  function () {
    Route::get('/comment',             [CommentController::class, 'index'])->name('all');
    Route::get('/comment/{commentId}', [CommentController::class, 'show'])->name('show');
});

Route::group(
  [
      'as' => 'comment:',
      'namespace' => 'App\Http\Controllers\Blog',
      'middleware' => ['auth:api'],
  ],
  function () {
    Route::delete('/comment/{commentId}', [CommentController::class, 'destroy'])->name('delete');
    Route::post('/comment',               [CommentController::class, 'store'])->name('create');
    Route::put('/comment/{commentId}',    [CommentController::class, 'update'])->name('update');
});
