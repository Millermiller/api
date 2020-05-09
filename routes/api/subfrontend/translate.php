<?php

Route::get('/{language}/text/{text}', 'TextController@show');
Route::get('/{language}/syns/{id}', 'TextController@getSyns');
Route::post('/{language}/nextTLevel', 'TextController@nextLevel');

