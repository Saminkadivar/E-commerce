<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// User Controllers
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\CheckoutController;

// Vendor Controllers
use App\Http\Controllers\Vendor\ProductController as VendorProductController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Vendor\ReportController as VendorReportController;
use App\Http\Controllers\Vendor\Auth\VendorLoginController;
use App\Http\Controllers\Vendor\Auth\VendorRegisterController;

// Admin Controllers
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController as AdminVendorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductControllers as AdminProductController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/index', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ShopController::class, 'index'])->name('shop.products.index');
Route::get('/userproducts/{product}', [ShopController::class, 'show'])->name('shop.products.show');


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::prefix('user')->name('user.')->middleware(['auth:web', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
});

/*
|--------------------------------------------------------------------------
| Vendor Authentication
|--------------------------------------------------------------------------
*/
Route::middleware('guest:vendor')->group(function () {
    Route::get('vendor/login', [VendorLoginController::class, 'showLoginForm'])->name('vendor.login');
    Route::post('vendor/login', [VendorLoginController::class, 'login'])->name('vendor.login.submit');
    Route::get('vendor/register', [VendorRegisterController::class, 'showRegisterForm'])->name('vendor.register');
    Route::post('vendor/register', [VendorRegisterController::class, 'register'])->name('vendor.register.submit');
});

/*
|--------------------------------------------------------------------------
| Vendor Routes (Authenticated)
|--------------------------------------------------------------------------
*/
Route::prefix('vendor')->name('vendor.')->middleware('auth:vendor')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', VendorProductController::class);
    Route::get('/orders', [VendorOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [VendorOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/item/{id}/status', [VendorOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/profile', [VendorProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [VendorProfileController::class, 'update'])->name('profile.update');
    Route::get('/reports', [VendorReportController::class, 'index'])->name('reports.index');
    Route::post('/logout', [VendorLoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

        Route::resource('users', UserController::class)->only(['index', 'destroy']);
        Route::resource('vendors', AdminVendorController::class)->only(['index', 'destroy']);
        Route::resource('categories', CategoryController::class);
        Route::resource('products', AdminProductController::class);

        Route::get('profile/edit', [AdminController::class, 'editProfile'])->name('profile.edit');
        Route::put('profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');

        Route::get('/reports/sales', [AdminReportController::class, 'sales'])->name('reports.sales');
    });
});
require __DIR__.'/auth.php';
