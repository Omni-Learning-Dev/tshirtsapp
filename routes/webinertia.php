<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PesepayController;


Route::get('/', [PagesController::class,'welcome'])->name('welcome');
Route::get('/order/{category}', [PagesController::class,'order'])->name('order');
Route::get('/order/initiated/{order}', [PagesController::class,'orderInitiated'])->name('orderInitiated');
Route::get('/order/order-add-client/{order}', [PagesController::class,'orderAddClient'])->name('orderAddClient');
Route::get('/order/pay-order/{order}', [PagesController::class,'payorder'])->name('payorder');

Route::delete('/order/{order}/remove-size/{index}', [PagesController::class, 'removeSize'])->name('order.removeSize');
Route::post('/orders', [PagesController::class,'sendOrder'])->name('sendOrder');
Route::post('/send-order-quantities', [PagesController::class,'sendOrderQuantities'])->name('sendOrderQuantities');
Route::post('/add-client-to-order', [PagesController::class,'addClientToOrder'])->name('addClientToOrder');
Route::get('/contact',[PagesController::class,'contact'])->name('Contact');

Route::post('/initiate-payment', [PesepayController::class,'initiatePayment'])->name('initiatePayment');
Route::get('/payment-result/{id}', [PesepayController::class,'pesePayResult'])->name('pese-result');
Route::post('/payment-return', [PesepayController::class,'pesePayReturn'])->name('pese-return');
Route::get('/pesepay-checkout/{order}', [PesepayController::class,'pesePayCheckout'])->name('pesePayCheckout');
Route::get('/check-payment',[PesepayController::class,'pesePayReturnExternal'])->name('pesePayReturnExternal');
