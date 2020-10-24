<?php

Route::resource('/meta', 'App\Http\Controllers\MetaController',
    ['except' => ['edit', 'create']]
);
