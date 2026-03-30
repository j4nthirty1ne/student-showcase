<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
// Home page (public)
Route::get('/', function () {
    return view('public.home');
})->name('home');

// Public showcase routes
Route::get('/showcase', function () {
    return view('public.showcase.index');
})->name('showcase.index');

Route::get('/showcase/{id}', function () {
    return view('public.showcase.show');
})->name('showcase.show');

Route::get('/students/{id}', function () {
    return view('public.students.show');
})->name('students.show');

// Include all route files
require __DIR__ . '/auth.php';
require __DIR__ . '/student.php';
require __DIR__ . '/admin.php';
=======
Route::get('/', function () {
    return view('welcome');
});
>>>>>>> main
