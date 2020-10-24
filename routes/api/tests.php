<?php


Route::post('/result/{asset}', 'App\Http\Controllers\Learn\TestController@result');
Route::post('/complete/{asset}', 'App\Http\Controllers\Learn\TestController@complete');
