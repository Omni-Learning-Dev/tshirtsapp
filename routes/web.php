<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PagesController::class,'welcome'])->name('home');

Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/how-it-works', [PagesController::class, 'howItWorks'])->name('how-it-works');
Route::get('/shop', [PagesController::class, 'shop'])->name('shop');
Route::post('/shop/add-to-cart', [PagesController::class, 'addToCart'])->name('shop.add-to-cart');

Route::post('/shop/remove-from-cart', [PagesController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/shop/update-cart', [PagesController::class, 'updateCart'])->name('cart.update');
Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout');

Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');
Route::get('/order-confirmation/{order_number}', [OrderController::class, 'orderConfirmation'])->name('order.confirmation');
Route::get('/order-pdf/{order_number}', [OrderController::class, 'downloadOrderPdf'])->name('order.pdf');
Route::get('/print-order/{order_number}', [OrderController::class, 'printOrder'])->name('order.print');


Route::get('/view-product/{slug}', [PagesController::class, 'viewProduct'])->name('view.product');
Route::get('/cart', [PagesController::class, 'cart'])->name('cart');

Route::get('/check-payment',[PaymentController::class,'pesePayReturnExternal'])->name('pesePayReturnExternal');
Route::get('/payment-success/{id}', [PaymentController::class,'pesePayResult'])->name('pese-result');
Route::get('/pese-pay/checkout', [PaymentController::class,'pesePayCheckout'])->name('pesePayCheckout');
Route::get('/payment/gateway/{order_number}', [PaymentController::class, 'paymentGateway'])->name('payment.gateway');


Route::get('/invoice/{order}/print', [InvoiceController::class, 'print'])->name('invoice.print');
Route::get('/invoice/{order}/download', [InvoiceController::class, 'download'])->name('invoice.download');
Route::get('/order/{order}/track', [OrderController::class, 'track'])->name('order.track');

Route::get('/terms', function() {
    return view('pages.terms');
})->name('terms');
