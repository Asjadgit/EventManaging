<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BaseRouteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend & Auth Routes (specific ones come first)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');



Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/*
|--------------------------------------------------------------------------
| Frontend Catch-All Route (put this last)
|--------------------------------------------------------------------------
|
| This route handles all frontend pages like /, /about, /contact, etc.
| The "where" condition excludes admin, api, and login paths
| so they don't get intercepted by this catch-all route.
|
*/

Route::get('/{slug?}', [BaseRouteController::class, 'page'])
    ->where('slug', '^(?!admin|api|login).*$')
    ->name('page');


