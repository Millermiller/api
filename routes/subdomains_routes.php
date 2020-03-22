<?php

/**
 * Created by PhpStorm.
 * User: john
 * Date: 27.09.2018
 * Time: 23:24
 */

/***************************** SUBDOMAIN - PUBLIC **********************************/

Route::group([

], function () {
    Route::get('/login', 'Sub\Frontend\IndexController@index')->middleware('guest');
    Route::post('/login', 'Auth\LoginSubController@login')->middleware('checkDomain')->name('login');
});

Route::group([
    'middleware' => ['checkDomain', 'touchUser', 'checkPlan', 'auth:api'],
    'namespace' => 'Sub\Frontend',
    'as' => 'sub_frontend::'
], function () {
    Route::post('/logout', 'LogoutController@index');

    Route::get('/', 'IndexController@index');

    Route::get('/{language}/check', 'IndexController@check')->name('check');
    Route::get('/state', 'IndexController@getState');
    Route::get('/user', 'IndexController@getUser')->name('user-info');
    Route::get('/info', 'IndexController@getInfo')->name('site-info');

    Route::post('/feedback', 'IndexController@feedback')->name('subdomain-feedback')->middleware(['addUserName']);
});

/******************************** SUBDOMAIN - ADMIN ***********************************/

Route::group([
    'middleware' => ['checkDomain'],
], function () {
    Route::get('/admin/login', 'Auth\LoginAdminController@showLoginForm');
    Route::post('/admin/login', 'Auth\LoginAdminController@login');
});

Route::group([
    'middleware' => ['checkAdmin', 'checkDomain', 'touchUser'],
    'namespace' => 'Sub\Backend',
    'prefix' => 'admin'
], function () {

    Route::get('/', 'VueController@index');


    Route::get('/logout', 'VueController@logout');

    Route::get('/dashboard', 'DashboardController@index');
    Route::delete('/log/{id}', 'DashboardController@deleteLog');
    Route::delete('/message/{id}', 'DashboardController@deleteMessage');
    Route::post('/message/read/{id}', 'DashboardController@readMessage');

    Route::resource('/intro', 'IntroController');
});
