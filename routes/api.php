<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Correct the capitalization here

// Public routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware('web')->post('/login', [authController::class, 'login']);

// Protected routes (Require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
});


