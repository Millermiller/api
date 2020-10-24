<?php

Route::get('/{language}/puzzle/all', 'App\Http\Controllers\Puzzle\PuzzleController@index');
Route::get('/{language}/puzzle/user', 'App\Http\Controllers\Puzzle\PuzzleController@byUser');
Route::get('/{language}/puzzle/{puzzle}', 'App\Http\Controllers\Puzzle\PuzzleController@show');
Route::put('/{language}/puzzle/{puzzle}/complete', 'App\Http\Controllers\Puzzle\PuzzleController@complete');
Route::post('/{language}/puzzle', 'App\Http\Controllers\Puzzle\PuzzleController@store');
Route::delete('/puzzle/{puzzle}', 'App\Http\Controllers\Puzzle\PuzzleController@destroy');