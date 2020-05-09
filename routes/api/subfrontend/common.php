<?php

//Route::get('/{language}/state', 'IndexController@state')->name('state');
Route::get('/user', 'IndexController@getUser')->name('user-info');
Route::get('/info', 'IndexController@getInfo')->name('site-info');

Route::post('/feedback', 'IndexController@feedback')->name('subdomain-feedback')->middleware(['addUserName']);
