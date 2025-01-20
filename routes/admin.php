<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PriceController;


Route::group([
    'middleware' =>  'auth',
    'prefix' => 'admin',
    'as' => 'admin.',

], function () {

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('products', ProductController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('enquiries', EnquiryController::class);
    Route::resource('prices', PriceController::class);
});
