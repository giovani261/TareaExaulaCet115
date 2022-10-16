<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TwoFAController;

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

Route::get('2fa', [TwoFAController::class, 'index'])->name('2fa.index');
Route::get('2far', [TwoFAController::class, 'indexR'])->name('2fa.indexR');
Route::post('2fa', [TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [TwoFAController::class, 'resend'])->name('2fa.resend');

Route::get('/roles', [App\Http\Controllers\HomeController::class, 'roles'])->name('roles');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create', App\Http\Livewire\Product\Create::class)->name('products.create')->middleware('auth','2fa');

Route::get('/products/{product}', App\Http\Livewire\Product\Show::class)->name('products.show');

Route::get('/checkout', App\Http\Livewire\Checkout::class)->name('checkout')->middleware('check');

Route::get('/paypal/payment', [PaymentController::class, 'paypalPaymentRequest'])->name('paypal.payment')->middleware('auth','2fa');

Route::get('/paypal/checkout/{status}', [PaymentController::class, 'paypalCheckout'])->name('paypal.checkout');

Route::post('/stripe/checkout', [PaymentController::class, 'stripeCheckout'])->name('stripe.checkout')->middleware('auth','2fa');

Route::get('/order/complete/{order}', [App\Http\Controllers\CompleteOrderController::class, 'completeForm'])->name('order.complete');

Route::post('/order/{order}', [App\Http\Controllers\CompleteOrderController::class, 'completeOrder'])->name('complete');

Route::get('/cryptopayment', [PaymentController::class, 'coinbaseCheckout'])->name('crypto.payment')->middleware('auth','2fa');

Route::get('/cryptopayment/cryptocom', [PaymentController::class, 'cryptocomCheckout'])->name('crypto.cryptocom.payment')->middleware('auth','2fa');

Route::get('/categorias/{categoria_id}', App\Http\Livewire\Categorias\Products::class)->name('categoria.show');

Route::get('/preguntasFrecuentes', [App\Http\Controllers\HomeController::class,'AQ'])->name('preguntas_frecuentes');

Route::get('/ordenes', [App\Http\Controllers\OrderController::class, 'index'])->name('ordenes.index')->middleware('auth','2fa');

Route::get('/archivo', [App\Http\Controllers\OrderController::class, 'archivo'])->name('ordenes.archivo')->middleware('auth','2fa');

Route::get('/archivar/{order_id}/{par?}', [App\Http\Controllers\OrderController::class, 'archivar'])->name('ordenes.archivar')->middleware('auth','2fa');

Route::get('/ordenes/{order_id}', [App\Http\Controllers\OrderController::class, 'detalle'])->name('ordenes.detalle')->middleware('auth','2fa');

Route::get('/ordenesAdmin', [App\Http\Controllers\OrderController::class, 'indexAdmin'])->name('ordenes.indexAdmin')->middleware('auth','2fa');

Route::get('/ordenesAdmin/{order_id}', [App\Http\Controllers\OrderController::class, 'detalleAdmin'])->name('ordenes.detalleAdmin')->middleware('auth','2fa');

Route::get('/ordenesAdminEstado/{order_id}/{par?}', [App\Http\Controllers\OrderController::class, 'cambiarEstado'])->name('ordenes.cambiarEstado')->middleware('auth','2fa');