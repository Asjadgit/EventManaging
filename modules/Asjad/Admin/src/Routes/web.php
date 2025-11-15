<?php

use Asjad\Admin\Controllers\AuthController;
use Asjad\Admin\Controllers\Events\EventCategoryController;
use Asjad\Admin\Controllers\Events\EventController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('admin/login', [AuthController::class, 'loginForm']);
    Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login');

    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/dashboard', [AuthController::class,'dashboard'])->name('admin.dashboard');
        Route::post('/logout',[AuthController::class,'logout'])->name('admin.logout');


        Route::prefix('events')->group(function() {
            Route::get('/categories',[EventCategoryController::class,'index'])->name('admin.events.categories');

            Route::get('/categories/create',[EventCategoryController::class,'create'])->name('admin.events.categories.create');

            Route::post('/categories/store',[EventCategoryController::class,'store'])->name('admin.events.categories.store');

            Route::get('/categories/{id}/edit',[EventCategoryController::class,'edit'])->name('admin.events.categories.edit');

            Route::put('/categories/{id}/update',[EventCategoryController::class,'update'])->name('admin.events.categories.update');

            Route::get('/categories/{id}/delete',[EventCategoryController::class,'destroy'])->name('admin.events.categories.delete');

            Route::get('/',[EventController::class,'index'])->name('admin.events.index');
        });
    });
});
