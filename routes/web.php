<?php

use Illuminate\Support\Facades\Route;

// Root route - redirect or show dashboard
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/student/dashboard');
    }
    return redirect('/login');
})->name('home');

// Authentication routes
require __DIR__.'/auth.php';

// Student routes (authenticated users)
require __DIR__.'/student.php';

// Admin routes (authenticated + admin users only)
require __DIR__.'/admin.php';
