<?php


use App\Http\Controllers\Seller\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Seller\Auth\RegisteredUserController;
use App\Http\Controllers\Seller\SellerController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest:seller')->prefix('seller')->group(function(){
    
    Route::get('/login', [AuthenticatedSessionController::class, 'create']);
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('seller.login');
    

    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('seller.register');
    
});


Route::middleware('seller')->prefix('seller')->group(function(){
    
    Route::get('/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('seller.logout');

});