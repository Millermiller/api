<?php

Route::get('/{language}/text/{text}', 'App\Http\Controllers\Translate\TextController@show');
Route::get('/{language}/syns/{id}', 'App\Http\Controllers\Translate\TextController@getSyns');
Route::post('/{language}/nextTLevel', 'App\Http\Controllers\Translate\TextController@nextLevel');
Route::get('/{language}/texts', 'App\Http\Controllers\Translate\TextController@all');
Route::post('/text/publish', 'App\Http\Controllers\Translate\TextController@publish');
Route::post('/text/{id}', 'App\Http\Controllers\Translate\TextController@textedit');
Route::post('/text', 'App\Http\Controllers\Translate\TextController@textcreate');
Route::delete('/text/{id}', 'App\Http\Controllers\Translate\TextController@textdelete');
Route::get('/text/{id}', 'App\Http\Controllers\Translate\TextController@getText');
Route::post('/text/extra', 'App\Http\Controllers\Translate\TextController@addExtras');
Route::post('/text/sentences', 'App\Http\Controllers\Translate\TextController@saveSentences');
Route::get('/text/synonyms/{id}', 'App\Http\Controllers\Translate\TextController@getSynonyms');
Route::post('/text/synonym', 'App\Http\Controllers\Translate\TextController@addSynonym');
Route::delete('/text/synonym/{id}', 'App\Http\Controllers\Translate\TextController@deleteSynonym');
Route::post('/text/image/{id}', 'App\Http\Controllers\Translate\TextController@uploadImage');
Route::post('/text/description/{id}', 'App\Http\Controllers\Translate\TextController@updateDescription');