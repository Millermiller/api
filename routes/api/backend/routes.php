<?php


Route::get('/', 'VueController@index')->name('admin');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::post('/message/read/{id}', 'DashboardController@readMessage');

Route::get('/users/search', 'UsersController@search')->name('search');
Route::resource('/users', 'UsersController',
    ['except' => ['create', 'edit']]
);

Route::get('/articles/search', 'ArticleController@search')->name('search');
Route::post('/articles/upload', 'ArticleController@upload')->name('upload');
Route::resource('/articles', 'ArticleController',
    ['except' => ['create', 'edit']]
);

Route::resource('/categories', 'CategoryController',
    ['except' => ['edit', 'create']]
);

Route::get('/comments/search', 'CommentController@search')->name('search');
Route::resource('/comments', 'CommentController',
    ['except' => ['edit', 'create']]
);

Route::resource('/meta', 'MetaController',
    ['except' => ['edit', 'create']]
);

Route::resource('/plan', 'PlanController');

Route::post('/send', 'VueController@testmail');

Route::resource('/log', 'LogController', ['except' => ['edit', 'create']]);

Route::resource('/message', 'MessageController', ['except' => ['edit', 'create']]);
