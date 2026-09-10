<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HoopShop\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\HoopShop\Admin\CustomerController;
use App\Http\Controllers\HoopShop\Admin\DashboardController;
use App\Http\Controllers\HoopShop\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\HoopShop\Admin\ProductController;
use App\Http\Controllers\HoopShop\AuthController;
use App\Http\Controllers\HoopShop\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/person', function () {
    return view('person');
});

Route::get('/page1/{artist}', function (string $artist) {
    return view('pages.page1', compact('artist'));
})->name('page1');

Route::get('/page2', [BookController::class, 'index'])->name('page2');

Route::get('/page3', function () {
    return view('pages.page3');
})->name('page3');

Route::get('/movie/{title}', function (string $title) {
    return view('pages.movie', compact('title'));
})->name('movie');

Route::get('/book/{title}', function (string $title) {
    return view('pages.book', compact('title'));
})->name('book');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

// Book CRUD Routes
Route::get('/p2', [BookController::class, 'index']);
Route::get('/book-form', [BookController::class, 'show_add_form']);
Route::post('/add-book', [BookController::class, 'do_add']);
Route::get('/edit-book/{id}', [BookController::class, 'show_edit_form']);
Route::post('/update-book', [BookController::class, 'do_update']);
Route::get('/delete-book/{id}', [BookController::class, 'do_delete']);

// ============================================================
// HOOP SHOP - storefront (browse, client auth, cart, orders)
// ============================================================

Route::prefix('hoop-shop')->group(function () {
    // Storefront browse
    Route::get('/', [ShopController::class, 'index'])->name('hoop-shop');

    // Auth (client and admin use the same login)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('hoop.login');
    Route::post('/login', [AuthController::class, 'login'])->name('hoop.login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('hoop.register');
    Route::post('/register', [AuthController::class, 'register'])->name('hoop.register.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('hoop.logout');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('hoop.admin.logout');

    // Cart
    Route::get('/cart', [ShopController::class, 'cart'])->name('hoop.cart');
    Route::post('/cart/add/{product}', [ShopController::class, 'addToCart'])->name('hoop.cart.add');
    Route::post('/cart/update', [ShopController::class, 'updateCart'])->name('hoop.cart.update');
    Route::post('/cart/remove/{product}', [ShopController::class, 'removeFromCart'])->name('hoop.cart.remove');

    // Checkout + my orders (client-only pages; admins are blocked)
    Route::middleware(['no-cache', 'client'])->group(function () {
        Route::get('/dashboard', [ShopController::class, 'dashboard'])->name('hoop.dashboard');
        Route::get('/checkout', [ShopController::class, 'showCheckout'])->name('hoop.checkout');
        Route::post('/checkout/start', [ShopController::class, 'startCheckout'])->name('hoop.checkout.start');
        Route::post('/checkout', [ShopController::class, 'placeOrder'])->name('hoop.checkout.place');
        Route::get('/my-orders', [ShopController::class, 'myOrders'])->name('hoop.orders');
    });

    // Account pages shared by clients and admins (any logged-in user)
    Route::middleware(['no-cache', 'account'])->group(function () {
        Route::get('/profile', [AuthController::class, 'editProfile'])->name('hoop.profile');
        Route::post('/profile', [AuthController::class, 'updateProfile'])->name('hoop.profile.update');
        Route::post('/profile/password', [AuthController::class, 'updatePassword'])->name('hoop.profile.password');
    });

    // ============================================================
    // HOOP SHOP - admin area (within dashboard)
    // ============================================================

    Route::prefix('admin')->group(function () {
        // Protected by admin middleware only (clients/guests are blocked)
        Route::middleware(['no-cache', 'admin'])->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('hoop.admin.dashboard');

            // Products CRUD
            Route::get('/products', [ProductController::class, 'index'])->name('hoop.admin.products');
            Route::get('/products/create', [ProductController::class, 'create'])->name('hoop.admin.products.create');
            Route::post('/products', [ProductController::class, 'store'])->name('hoop.admin.products.store');
            Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('hoop.admin.products.edit');
            Route::put('/products/{product}', [ProductController::class, 'update'])->name('hoop.admin.products.update');
            Route::get('/products/{product}/delete', [ProductController::class, 'destroy'])->name('hoop.admin.products.destroy');

            // Customers CRUD
            Route::get('/customers', [CustomerController::class, 'index'])->name('hoop.admin.customers');
            Route::get('/customers/create', [CustomerController::class, 'create'])->name('hoop.admin.customers.create');
            Route::post('/customers', [CustomerController::class, 'store'])->name('hoop.admin.customers.store');
            Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('hoop.admin.customers.edit');
            Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('hoop.admin.customers.update');
            Route::post('/customers/{customer}/toggle-active', [CustomerController::class, 'toggleActive'])->name('hoop.admin.customers.toggleActive');
            Route::get('/customers/{customer}/delete', [CustomerController::class, 'destroy'])->name('hoop.admin.customers.destroy');

            // Orders management
            Route::get('/orders', [AdminOrderController::class, 'index'])->name('hoop.admin.orders');
            Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('hoop.admin.orders.status');
            Route::get('/orders/{order}/delete', [AdminOrderController::class, 'destroy'])->name('hoop.admin.orders.destroy');
        });
    });
});
