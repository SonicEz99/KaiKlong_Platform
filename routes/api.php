<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
// use App\Http\Controllers\;

// Public routes
Route::post('/register', [authController::class, 'register']);
Route::post('/login', [authController::class, 'login']);

// Protected routes (Require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [authController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
});

