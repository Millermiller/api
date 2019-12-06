<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/languages', 'Main\Frontend\ApiController@languages')->name('languages');

Route::get('/assets/{language}', 'Main\Frontend\ApiController@assets')->middleware('auth:api');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response()->json($request->user());
});