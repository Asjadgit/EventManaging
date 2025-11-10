<?php

use Asjad\Admin\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('admin/login', [AuthController::class, 'loginForm']);
    Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login');

    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/dashboard', [AuthController::class,'dashboard'])->name('admin.dashboard');
        Route::post('/logout',[AuthController::class,'logout'])->name('admin.logout');
    });
});
