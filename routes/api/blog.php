<?php


Route::group(
    [
        'as' => 'post:',
        'namespace' => 'App\Http\Controllers\Blog',
        'middleware' => [],
    ],
    function () {
        Route::get(
            '/post',
            [
                'as' => 'all',
                'uses' => 'PostController@index',
            ]
        );

        Route::get(
            '/post/{postId}',
            [
                'as' => 'show',
                'uses' => 'PostController@show',
            ]
        );

        Route::get(
            '/post/search',
            [
                'as' => 'search',
                'uses' => 'PostController@search',
            ]
        );
    }
);

Route::group(
    [
        'as' => 'post:',
        'namespace' => 'App\Http\Controllers\Blog',
        'middleware' => ['auth:api'],
    ],
    function () {

        Route::delete(
            '/post/{postId}',
            [
                'as' => 'delete',
                'uses' => 'PostController@destroy',
            ]
        );

        Route::post(
            '/post',
            [
                'as' => 'create',
                'uses' => 'PostController@store',
            ]
        );

        Route::put(
            '/post/{postId}',
            [
                'as' => 'update',
                'uses' => 'PostController@update',
            ]
        );

        Route::post(
            '/post/upload',
            [
                'as' => 'upload',
                'uses' => 'PostController@upload',
            ]
        );
    }
);


Route::get('/category', 'App\Http\Controllers\Blog\CategoryController@index')->name('category:all');
Route::get('/category/{categoryId}', 'App\Http\Controllers\Blog\CategoryController@show')->name('category:show');
Route::delete('/category/{categoryId}', 'App\Http\Controllers\Blog\CategoryController@destroy')
    ->name('category:delete')->middleware(['auth:api']);
Route::post('/category', 'App\Http\Controllers\Blog\CategoryController@store')
    ->name('category:create')->middleware(['auth:api']);
Route::put('/category/{categoryId}', 'App\Http\Controllers\Blog\CategoryController@update')
    ->name('category:update')->middleware(['auth:api']);

Route::get('/comment', 'App\Http\Controllers\Blog\CommentController@index')->name('comment:all');
Route::get('/comment/{commentId}', 'App\Http\Controllers\Blog\CommentController@show')->name('comment:show');
Route::delete('/comment/{commentId}', 'App\Http\Controllers\Blog\CommentController@destroy')
    ->name('comment:delete')->middleware(['auth:api']);
Route::post('/comment', 'App\Http\Controllers\Blog\CommentController@store')
    ->name('comment:create')->middleware(['auth:api']);
Route::put('/comment/{commentId}', 'App\Http\Controllers\Blog\CommentController@update')
    ->name('comment:update')->middleware(['auth:api']);
