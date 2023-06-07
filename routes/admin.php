<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CouponsUserController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PopupAdsController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\ShippingCoseController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:admin')->prefix('admin')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create']);
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login');
    // Route::get('/register', [RegisteredUserController::class, 'create']);
    // Route::post('/register', [RegisteredUserController::class, 'store'])->name('admin.register');
});



Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

    // admins controller route
    Route::get('/admins', [AdminController::class, 'index']);
    Route::post('/store', [AdminController::class, 'store'])->name('admin.admins.store');
    Route::get('/show/{id}', [AdminController::class, 'show']);
    Route::post('/update', [AdminController::class, 'update'])->name('admin.admins.update');
    Route::get('/trash/{id}', [AdminController::class, 'trash']);

    // admin profile controller route
    Route::get('/profile', [AdminProfileController::class, 'index']);
    Route::post('/profile/upload', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/password/check/{password}', [AdminProfileController::class, 'check']);
    Route::post('/password/update', [AdminProfileController::class, 'change'])->name('admin.password.update');

    // popup ads controller route
    Route::prefix('popup_ads')->group(function () {
        Route::get('/', [PopupAdsController::class, 'index'])->name('admin.popupads');
        Route::post('/store', [PopupAdsController::class, 'store'])->name('admin.popupads.store');
        Route::get('/show/{id}', [PopupAdsController::class, 'show']);
        Route::post('/update', [PopupAdsController::class, 'update'])->name('admin.popupads.update');
        Route::get('/trash/{id}', [PopupAdsController::class, 'trash']);
    });

    // sliders controller route
    Route::prefix('sliders')->group(function() {
        Route::get('/', [SliderController::class, 'index']);
        Route::post('/store', [SliderController::class, 'store'])->name('admin.slider.store');
        Route::get('/show/{id}', [SliderController::class, 'show']);
        Route::post('/update', [SliderController::class, 'update'])->name('admin.slider.update');
        Route::get('/trash/{id}', [SliderController::class, 'trash']);
    });

    // Navigation controller route
    Route::prefix('navigation')->group(function() {
        Route::get('/', [NavigationController::class, 'index'])->name('admin.navigation');
        Route::post('/store', [NavigationController::class, 'store'])->name('admin.navigation.store');
        Route::get('/show/{id}', [NavigationController::class, 'show']);
        Route::post('/update', [NavigationController::class, 'update'])->name('admin.navigation.update');
        Route::get('/trash/{id}', [NavigationController::class, 'trash']);
    });

    // categories controller route
    Route::prefix('categories')->group(function() {
        Route::get('/', [CategoriesController::class, 'index'])->name('admin.category');
        Route::post('/store', [CategoriesController::class, 'store'])->name('admin.category.store');
        Route::get('/show/{id}', [CategoriesController::class, 'show']);
        Route::post('/update', [CategoriesController::class, 'update'])->name('admin.category.update');
        Route::get('/trash/{id}', [CategoriesController::class, 'trash']);
    });

    // company address controller route
    Route::prefix('company')->group(function(){
        Route::get('/', [CompanyController::class, 'index'])->name('admin.company');
        Route::post('/collection', [CompanyController::class, 'collection'])->name('admin.company.collection');
    });

    // user controller route
    Route::prefix('customers')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('admin.customer');
    });
});

Route::get('/install', [CompanyController::class, 'install']);