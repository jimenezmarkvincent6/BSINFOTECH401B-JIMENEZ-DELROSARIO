<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('account/login', 'index')->name('account.login');
        Route::post('account/authenticate', 'authenticate')->name('account.authenticate');
        Route::get('account/register', 'register')->name('account.register');
        Route::post('account/processRegister', 'processRegister')->name('account.processRegister');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('account/logout', 'logout')->name('account.logout');
        Route::get('account/admin', 'admin')->name('account.admin');
        Route::delete('/account/{id}', 'destroy')->name('account.delete');
        Route::get('/account/edit', [LoginController::class, 'edited'])->name('account.edited');
        Route::put('/account/{user}', 'updated')->name('account.updated');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('products.index');
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/{product}/edit', 'edit')->name('products.edit');
        Route::put('/products/{product}', 'update')->name('products.update');
        Route::delete('/products/{product}', 'destroy')->name('products.destroy');
    });
});
