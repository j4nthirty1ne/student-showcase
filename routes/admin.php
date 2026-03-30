<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

// All admin routes require: authentication + admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index');
        Route::get('/{user}', [UserManagementController::class, 'show'])->name('show');
        Route::put('/{user}/status', [UserManagementController::class, 'updateStatus'])->name('status');
        Route::put('/{user}/role', [UserManagementController::class, 'changeRole'])->name('role');
        Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
    });
});
