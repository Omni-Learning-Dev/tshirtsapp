<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;


Route::group([
    'middleware' =>  'auth',
    'prefix' => 'admin',
    'as' => 'admin.',

],function(){

    Route::get('dashboard', [AdminController::class,'dashboard'])->name('dashboard');
    Route::resource('categories',CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('products', OrderController::class);
    Route::resource('clients', OrderController::class);
    Route::resource('enquiries', OrderController::class);

});


