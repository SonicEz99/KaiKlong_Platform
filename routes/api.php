<?php

use App\Http\Controllers\chatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\brandController;
use App\Http\Controllers\productController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\favoriteController;
use App\Http\Controllers\authController; // Correct the capitalization here
use App\Http\Controllers\TypeController; // Correct the capitalization here

// Public routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware('web')->post('/login', [authController::class, 'login']);
Route::middleware('web')->post('/Googlelogin', [authController::class, 'handleGoogle']);

Route::post('/addCategory', [categoryController::class, 'addCategory']);
Route::get('/categories', [CategoryController::class, 'getCategory']);
Route::get('/categories/{id}', [CategoryController::class, 'getCategoryById']);
Route::get('/categoriesBrandAndType', [CategoryController::class, 'getCategoryAndBrandAndType']);
Route::get('/categoriesBrandAndType/{id}', [CategoryController::class, 'getCategoryAndBrandAndTypeById']);
Route::get('/get24product', [productController::class, 'getProduct24']);
Route::get('/get24productsearch', [ProductController::class, 'getFilteredProducts']); // API endpoint
Route::get('/getProductsByUser/{id}', [ProductController::class, 'getProductsByUserId']); // API endpoint
Route::get('/deleteProduct/{id}', [ProductController::class, 'deleteProduct']); // API endpoint

Route::get('/getApprove', [ProductController::class, 'approve']); // API endpoint
Route::get('/getUnApprove', [ProductController::class, 'unApprove']); // API endpoint
Route::put('/approve/{id}', [ProductController::class, 'updateApprove']);

Route::get('/types', [TypeController::class, 'index']);
Route::get('/types/category/{category_id}', [TypeController::class, 'getByCategory']);
Route::get('/types/first-ten', [TypeController::class, 'getFirstTenTypes']);


Route::post('/addBrand1', [brandController::class, 'addBrand1']);
Route::post('/addBrand2', [brandController::class, 'addBrand2']);
Route::get('/getFourBrand', [brandController::class, 'getFourBrand']);

Route::post('/addProduct', [productController::class, 'addProduct'])->name("product.store");
Route::get('/product', [productController::class, 'getProduct']);
Route::delete('/deleteProduct/{id}', [productController::class, 'deleteProduct']);
Route::post('/updateProduct/{id}', [productController::class, 'updateProduct'])->name("product.update");
Route::get('/product/{id}', [ProductController::class, 'getProductById']);

Route::post('/updateUser/{id}', [userController::class, 'updateUser']);
Route::get('/getUser/{id}', [userController::class, 'getUser']);


Route::get('/peoplechat/{id}', [chatController::class, 'getPeople']);
Route::get('/message/{id}/{buyer_id}', [chatController::class, 'getMessagesBuyer']);
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

Route::post('/addFavorite', [favoriteController::class, 'addFavorite']);
Route::get('/getFavorite/{id}', [favoriteController::class, 'getFavorite']);
Route::delete('/deleteFavorite/{id}', [favoriteController::class, 'deleteFavorite']);

// Protected routes (Require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
});


