<?php


Route::get('/', 'IndexController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/settings', 'ProfileController@settings')->name('profile-settings');
Route::get('/profile/log', 'ProfileController@log')->name('profile-log');
Route::post('/profile/uploadImage', 'ProfileController@uploadImage');
Route::post('/profile/update', 'ProfileController@edit')->name('profile-update');

Route::get('/pay', 'PaymentController@index')->name('payment');

Route::post('/pay/success', 'PaymentController@handlePayment')->name('paymentcallback');

Route::get('/pay/{name}', 'PaymentController@plan')->name('plan');
Route::post('/pay', 'PaymentController@process')->name('process');

