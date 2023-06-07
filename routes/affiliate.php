<?php

use App\Http\Controllers\Affiliate\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Affiliate\Auth\RegisteredUserController;
use App\Http\Controllers\Affiliate\AffiliateController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest:affiliate')->prefix('affiliate')->group(function(){
    
    Route::get('/login', [AuthenticatedSessionController::class, 'create']);
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('affiliate.login');
    
    
    Route::get('register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('affiliate.register');
    

    

});


Route::middleware('affiliate')->prefix('affiliate')->group(function(){
    
    Route::get('/dashboard', [AffiliateController::class, 'index'])->name('affiliate.dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('affiliate.logout');

});