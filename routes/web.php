<?php

use Illuminate\Support\Facades\Route;

// ===========================
// AUTH CONTROLLERS
// ===========================
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// ===========================
// PROFILE
// ===========================
use App\Http\Controllers\ProfileController;

// ===========================
// ADMIN CONTROLLERS
// ===========================
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;

// ===========================
// CUSTOMER CONTROLLERS
// ===========================
use App\Http\Controllers\Customer\CustomerProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;


// PayPal callback (must be publicly accessible)
Route::get('/checkout/paypal/callback', [CheckoutController::class, 'handlePayPalCallback'])
    ->name('checkout.paypal.callback');


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Store homepage (product listing)
Route::get('/', [CustomerProductController::class, 'index'])->name('store.index');

// View single product
Route::get('/product/{product}', [CustomerProductController::class, 'show'])->name('store.show');

// ===========================
// AUTH ROUTES
// ===========================
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ===========================
// CUSTOMER ROUTES (AUTH REQUIRED)
// ===========================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Customer Orders
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])->name('orders.show');
    });

    // Cart
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'view'])->name('view');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::post('/update/{product}', [CartController::class, 'update'])->name('update');
        Route::post('/remove/{product}', [CartController::class, 'remove'])->name('remove');
    });


  // Checkout + PayPal
Route::prefix('checkout')->name('checkout.')->group(function () {

    // Checkout page
    Route::get('/', [CheckoutController::class, 'index'])->name('index');

    // Place Order
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');

    // PayPal - Create Payment
    Route::get('/paypal/{order}', [CheckoutController::class, 'payWithPayPal'])
        ->name('paypal');

    // PayPal - Callback (after approval)
    Route::get('/paypal/callback', [CheckoutController::class, 'handlePayPalCallback'])
        ->name('paypal.callback');
});


});

// ===========================
// ADMIN ROUTES (AUTH + ADMIN)
// ===========================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Products
        Route::resource('products', ProductController::class);

        // Categories
        Route::resource('categories', CategoryController::class);

        // Orders
        Route::resource('orders', AdminOrderController::class)->only(['index','show','update']);

        // Users
        Route::resource('users', UserController::class);
    });
