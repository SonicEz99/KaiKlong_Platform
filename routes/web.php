<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Login Page Route
Route::get('/', function () {
    return view('auth.login_auth');
})->name('login.page');

// Register Page Route
Route::get('/register', function () {
    return view('auth.register_auth');
})->name('register.page');

// Authentication Routes
Route::post('/register', [AuthController::class, 'register'])->name('register.backend');
Route::post('/login', [AuthController::class, 'login'])->name('login.backend');

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/about', function () {
        return view('about');
    });

    Route::get('/home', function () {
        return view('user.home')->name('user.home');
    });
});

