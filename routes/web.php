<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PesepayController;


Route::get('/', [PagesController::class,'welcome'])->name('home');

Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/how-it-works', [PagesController::class, 'howItWorks'])->name('how-it-works');
Route::get('/shop', [PagesController::class, 'shop'])->name('shop');

// Form Pages - Using Livewire
Route::get('/t-shirt-form', [FormController::class, 'tShirtForm'])->name('t-shirt-form');
Route::post('/t-shirt-order', [FormController::class, 'tShirtOrder'])->name('tshirt.order');

Route::get('/vests-form', [FormController::class, 'vestsForm'])->name('vests-form');
Route::post('/vest-order', [FormController::class, 'vestOrder'])->name('vest.order');


Route::get('/jackets-form', [FormController::class, 'jacketsForm'])->name('jackets-form');
Route::post('/jacket-order', [FormController::class, 'jacketOrder'])->name('jacket.order');

Route::get('/cap-form', [FormController::class, 'capForm'])->name('cap-form');
Route::post('/cap-order', [FormController::class, 'capOrder'])->name('cap.order');

Route::get('/hoodies-form', [FormController::class, 'hoodiesForm'])->name('hoodies-form');
Route::post('/hoodie-order', [FormController::class, 'hoodieOrder'])->name('hoodie.order');

Route::get('/golf-t-shirt-form', [FormController::class, 'golfTShirtForm'])->name('golf-t-shirt-form');
Route::post('/golf-t-shirt-order', [FormController::class, 'golfTShirtOrder'])->name('golf-tshirt.order');

include(__DIR__. '/admin.php');
