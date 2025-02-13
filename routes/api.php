<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Correct the capitalization here
use App\Http\Controllers\brandController;
use App\Http\Controllers\categoryController;

// Public routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware('web')->post('/login', [authController::class, 'login']);

Route::post('/addCategory', [categoryController::class, 'addCategory']);
Route::get('/categories', [CategoryController::class, 'getCategory']);
Route::get('/categories/{id}', [CategoryController::class, 'getCategoryById']);
Route::get('/categoriesBrandAndType', [CategoryController::class, 'getCategoryAndBrandAndType']);
Route::get('/categoriesBrandAndType/{id}', [CategoryController::class, 'getCategoryAndBrandAndTypeById']);

Route::post('/addBrand1', [brandController::class, 'addBrand1']);
Route::post('/addBrand2', [brandController::class, 'addBrand2']);

// Protected routes (Require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
});


