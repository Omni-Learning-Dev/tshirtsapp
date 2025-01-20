<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class,'welcome'])->name('welcome');
Route::get('/order/{category}', [PagesController::class,'order'])->name('order');
Route::post('/orders', [PagesController::class,'sendOrder'])->name('sendOrder');
Route::get('/contact',[PagesController::class,'contact'])->name('Contact');

include(__DIR__. '/admin.php');
