<?php

use Illuminate\Support\Facades\Route;

// ===========================
// AUTH CONTROLLERS
// ===========================
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ===========================
// CUSTOMER CONTROLLERS
// ===========================
use App\Http\Controllers\Customer\CustomerProductController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;

// ===========================
// ADMIN CONTROLLERS
// ===========================
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MessageController;

// ===========================
// PROFILE CONTROLLER
// ===========================
use App\Http\Controllers\ProfileController;

// ===========================
// CONTACT CONTROLLER
// ===========================
use App\Http\Controllers\ContactController;

// ===========================
// PUBLIC ROUTES
// ===========================

// Store homepage
Route::get('/', [CustomerProductController::class, 'index'])->name('store.index');

// Single product page
Route::get('/product/{product}', [CustomerProductController::class, 'show'])->name('store.show');

// PayPal callback (public)
Route::get('/checkout/paypal/callback', [CheckoutController::class, 'handlePayPalCallback'])
    ->name('checkout.paypal.callback');

// Contact form (public)
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.show');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// ===========================
// AUTH ROUTES (BREEZE + OTP)
// ===========================

// Registration
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
     ->middleware('verified')
     ->name('login.store');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// OTP verification
Route::get('/verify-otp', [OTPController::class, 'index'])->name('otp.verify.page');
Route::post('/verify-otp', [OTPController::class, 'verify'])->name('otp.verify');
Route::get('/otp/resend', [OTPController::class, 'resend'])->name('otp.resend');

// ===========================
// AUTH REQUIRED (CUSTOMER)
// ===========================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// In routes/web.php

Route::middleware(['auth', 'admin'])->group(function () {

    // Admin profile edit page
    Route::get('/admin/profile', [ProfileController::class, 'edit'])
        ->name('admin.profile.edit');

    Route::patch('/admin/profile', [ProfileController::class, 'update'])
        ->name('admin.profile.update');

});

    // Customer Orders
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/cancel', [CustomerOrderController::class, 'cancel'])->name('orders.cancel');
    });

    // Cart
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'view'])->name('view');
        Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
        Route::post('/update/{product}', [CartController::class, 'update'])->name('update');
        Route::post('/remove/{product}', [CartController::class, 'remove'])->name('remove');
    });

    // Checkout
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('process');
        Route::post('/cod', [CheckoutController::class, 'cod'])->name('cod');
        Route::get('/paypal/{order}', [CheckoutController::class, 'payWithPayPal'])->name('paypal');
    });
});

// ===========================
// ADMIN ROUTES
// ===========================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);

    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);

    Route::resource('users', UserController::class);
    Route::patch('/users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Admin messages
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('messages/reply/{id}', [MessageController::class, 'reply'])->name('messages.reply');
});
Route::get('/about', function () {
    return view('about');
})->name('about');
