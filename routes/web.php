<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    return view('auth.login_auth');
})->name('login.page');
;

// // Register Page Route
Route::get('/register', function () {
    return view('auth.register_auth');
})->name('register.page');

// // Authentication Routes
// Route::post('/register', [authController::class, 'register'])->name('register.backend');
// Route::post('/login', [authController::class, 'login'])->name('login.backend');

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/about', function () {
        return view('about');
    });
});

Route::middleware('web')->get('/home', function () {
    return view('user.home');
})->name('home');



Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogle');
});