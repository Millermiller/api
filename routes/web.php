<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/email', function () {
    return new App\Mail\Welcome([
        'login' => 'Username',
        'email' => 'example@mail.ru',
        'password' => 'qwerty123',
    ]);
});
Route::get('/emailreset', function () {
    $user = new \App\User();
    $user->login = 'Username';
    return new App\Mail\ResetPassword($user,'token');
});

include 'subdomains_routes.php';

include 'main_routes.php';