<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/roles', [App\Http\Controllers\HomeController::class, 'roles'])->name('roles');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create', App\Http\Livewire\Product\Create::class)->name('products.create')->middleware('auth');

Route::get('/products/{product}', App\Http\Livewire\Product\Show::class)->name('products.show');

Route::get('/checkout', App\Http\Livewire\Checkout::class)->name('checkout')->middleware('check');

Route::get('/paypal/payment', [PaymentController::class, 'paypalPaymentRequest'])->name('paypal.payment')->middleware('auth');

Route::get('/paypal/checkout/{status}', [PaymentController::class, 'paypalCheckout'])->name('paypal.checkout');

Route::post('/stripe/checkout', [PaymentController::class, 'stripeCheckout'])->name('stripe.checkout')->middleware('auth');

Route::get('/order/complete/{order}', [App\Http\Controllers\CompleteOrderController::class, 'completeForm'])->name('order.complete');

Route::post('/order/{order}', [App\Http\Controllers\CompleteOrderController::class, 'completeOrder'])->name('complete');

Route::get('/cryptopayment', [PaymentController::class, 'coinbaseCheckout'])->name('crypto.payment')->middleware('auth');