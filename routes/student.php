<?php

use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\ProjectsController;
use Illuminate\Support\Facades\Route;

// All student routes require authentication
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
    });

    // Projects routes
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectsController::class, 'index'])->name('index');
        Route::get('/create', [ProjectsController::class, 'create'])->name('create');
        Route::post('/', [ProjectsController::class, 'store'])->name('store');
        Route::get('/{project}', [ProjectsController::class, 'show'])->name('show');
        Route::get('/{project}/edit', [ProjectsController::class, 'edit'])->name('edit');
        Route::put('/{project}', [ProjectsController::class, 'update'])->name('update');
        Route::delete('/{project}', [ProjectsController::class, 'destroy'])->name('destroy');
    });
});
