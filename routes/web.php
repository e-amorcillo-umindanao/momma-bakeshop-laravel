<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductionBatchController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ReportController;

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Grouped routes requiring Authentication
Route::middleware(['auth'])->group(function () {

    // Example Dashboard route
    Route::get('/', function () {
        return view('dashboard'); // Placeholder for Step 2
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // Role-Specific Route examples using the CheckRole middleware
    Route::middleware(['role:Owner/Admin'])->group(function () {
        // User Management Routes
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::put('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    });

    Route::middleware(['role:Owner/Admin,Inventory Clerk'])->group(function () {
        // Inventory Dashboard (View Raw Materials, Finished Goods, and Low Stock Alerts)
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

        // Raw Material Stock In
        Route::get('/inventory/stock-in', [InventoryController::class, 'stockInForm'])->name('inventory.stock_in');
        Route::post('/inventory/stock-in', [InventoryController::class, 'storeStockIn'])->name('inventory.store_stock_in');

        // Raw Material Stock Out
        Route::get('/inventory/stock-out', [InventoryController::class, 'stockOutForm'])->name('inventory.stock_out');
        Route::post('/inventory/stock-out', [InventoryController::class, 'storeStockOut'])->name('inventory.store_stock_out');

        // Production Batches
        Route::get('/production/create', [ProductionBatchController::class, 'create'])->name('production.create');
        Route::post('/production', [ProductionBatchController::class, 'store'])->name('production.store');
    });

    Route::middleware(['role:Owner/Admin'])->group(function () {
        // Reports Dashboard
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        // Specific Reports
        Route::get('/reports/sales', [ReportController::class, 'salesReport'])->name('reports.sales');
        Route::get('/reports/inventory', [ReportController::class, 'inventoryReport'])->name('reports.inventory');
    });

    Route::middleware(['role:Owner/Admin,Cashier'])->group(function () {
        // POS Interface Route
        Route::get('/pos', [POSController::class, 'index'])->name('pos.index');

        // Process Sale Route
        Route::post('/pos/checkout', [POSController::class, 'checkout'])->name('pos.checkout');
    });
});