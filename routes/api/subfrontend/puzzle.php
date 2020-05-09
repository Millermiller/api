<?php

Route::resource('/{language}/puzzle', 'PuzzleController', ['except' => ['create', 'delete']]);
