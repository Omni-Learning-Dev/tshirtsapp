<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;


Route::resource('category',CategoryController::class);



// order routes

Route::resource('order', OrderController::class);
