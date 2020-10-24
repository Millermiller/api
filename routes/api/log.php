<?php

Route::resource('/log', 'App\Http\Controllers\Common\LogController', ['except' => ['edit', 'create']]);