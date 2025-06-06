<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RentersController;
use App\Http\Controllers\FrontConroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Combined auth middleware group for profile and dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Frontend routes
Route::controller(FrontConroller::class)->group(function () {
    Route::get('/', 'home')->name('front.home');
    Route::get('/about', 'about')->name('front.about');
    Route::get('/product', 'product')->name('front.product');
    Route::get('/productDetail/{id}', 'productDetail')->name('front.productDetail');
    Route::get('/recommended', 'recommended')->name('front.recommended');
    Route::get('/recommendedDetail/{id}', 'recommendedDetail')->name('front.recommendedDetail');
    Route::get('/checkout', 'checkout')->name('checkout');
    Route::post('/checkout/process', 'processCheckout')->name('checkout.process');
    Route::get('/checkout-finish', 'checkoutFinish')->name('checkout.finish');
});

// Admin routes
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('renters', RentersController::class);
});

// Authentication routes (includes logout)
require __DIR__ . '/auth.php';