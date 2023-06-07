<?php

use App\Helpers\Cart;
use App\Helpers\Custom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'welcome'])->name('welcome');
// Route::get('/', [FrontendController::class, 'welcome'])->name('welcome');
Route::get('categories/products/{slug}', [FrontendController::class, 'categories'])->name('categories');
Route::get('product-details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');

// cart section route
Route::post('add-to-cart', [CartController::class, 'add'])->name('add-to-cart');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('cart/qty/update', [CartController::class, 'quantity'])->name('quantity');
Route::get('cart/delete/{id}', [CartController::class, 'delete'])->name('delete');
Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('coupon', [CartController::class, 'coupon'])->name('coupon');
Route::post('coupon/update', [CartController::class, 'update'])->name('coupon.update');
Route::post('confirm', [CartController::class, 'confirm'])->name('confirm');
Route::get('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('cart/all', [CartController::class, 'all'])->name('cart.all');

// customers address router
Route::prefix('address')->group(function(){
    Route::get('/', [AddressController::class, 'index'])->name('address');
    Route::post('/store', [AddressController::class, 'store'])->name('address.store');
    Route::get('/show/{id}', [AddressController::class, 'show'])->name('address.show');
    Route::post('/update', [AddressController::class, 'update'])->name('address.update');
    Route::get('/delete/{id}', [AddressController::class, 'delete'])->name('address.delete');
});

Route::get('/test', [FrontendController::class, 'test']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/seller.php';
require __DIR__. '/affiliate.php';
