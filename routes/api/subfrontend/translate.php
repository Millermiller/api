<?php

Route::get('/{language}/text/{text}', 'Sub\Frontend\TextController@show');
Route::get('/{language}/syns/{id}', 'Sub\Frontend\TextController@getSyns');
Route::post('/{language}/nextTLevel', 'Sub\Frontend\TextController@nextLevel');

