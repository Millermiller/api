<?php

Route::resource('/message', 'App\Http\Controllers\Common\MessageController', ['except' => ['edit']]);
Route::post('/message/read/{id}', 'App\Http\Controllers\Common\MessageController@read');