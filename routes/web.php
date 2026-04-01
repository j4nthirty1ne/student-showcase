<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowcaseController;

// Public Showcase Route
Route::get('/', [ShowcaseController::class, 'index'])->name('home');
Route::get('/projects/{project}', [ShowcaseController::class, 'show'])->name('project.show');

// Authentication routes
require __DIR__ . '/auth.php';

// Student routes (authenticated users)
require __DIR__ . '/student.php';

// Admin routes (authenticated + admin users only)
require __DIR__ . '/admin.php';
