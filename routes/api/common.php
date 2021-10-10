<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Reader\ReaderController;
use App\Http\Controllers\Sub\Frontend\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/state',  [IndexController::class, 'state'])->name('state');
Route::get('/me',     [IndexController::class, 'getUser'])->name('user-info');
Route::get('/info',   [IndexController::class, 'getInfo'])->name('site-info');

Route::post('/feedback',    [FeedbackController::class, 'store'])->name('subdomain-feedback')->middleware(['addUserName']);

Route::get('/read',   ReaderController::class)->name('read')->middleware('file');

Route::get('/dashboard',    [DashboardController::class, 'all']);