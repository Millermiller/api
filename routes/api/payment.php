<?php

Route::get('/pay', 'App\Http\Controllers\PaymentController@index')->name('payment');
Route::post('/pay/success', 'App\Http\Controllers\PaymentController@handlePayment')->name('paymentcallback');
Route::get('/pay/{name}', 'App\Http\Controllers\PaymentController@plan')->name('plan');
Route::post('/pay', 'App\Http\Controllers\PaymentController@process')->name('process');