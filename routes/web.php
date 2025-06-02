<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RentersController;
use App\Http\Controllers\FrontConroller;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




Route::get('/', [FrontConroller::class, 'home'])->name('front.home');
Route::get('/about', [FrontConroller::class, 'about'])->name('front.about');
Route::get('/product', [FrontConroller::class, 'product'])->name('front.product');
Route::get('/productDetail/{id}', [FrontConroller::class, 'productDetail'])->name('front.productDetail');
Route::get('/recommended', [FrontConroller::class, 'recommended'])->name('front.recommended');
Route::get('/recommendedDetail/{id}', [FrontConroller::class, 'recommendedDetail'])->name('front.recommendedDetail');
Route::get('/checkout', [FrontConroller::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [FrontConroller::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout-finish', [FrontConroller::class, 'checkoutFinish'])->name('checkout.finish');

Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
})->name('logout');


Route::prefix('/admin')->middleware('auth')->group(function(){
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('renters', RentersController::class);
    
    
});



require __DIR__.'/auth.php';


