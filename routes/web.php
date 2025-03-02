<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\userController;


Route::get('/', function () {
    return view('auth.login_auth');
})->name('login.page');
;

// // Register Page Route
Route::get('/register', function () {
    return view('auth.register_auth');
})->name('register.page');

use App\Http\Controllers\authController;

Route::middleware('web')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // ✅ Ensure it's here
});



// // Authentication Routes
// Route::post('/register', [authController::class, 'register'])->name('register.backend');
// Route::post('/login', [authController::class, 'login'])->name('login.backend');

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/about', function () {
        return view('about');
    });
    Route::get('/product-all', function () {
        return view('product.product');
    });
    Route::get('/addproduct', function () {
        return view('product.addproduct');
    });
    Route::get('/product-detail/{id}', [ProductController::class, 'show'])->name('productdetail');
    Route::get('/product-listing/{id}', function () {
        return view('user.productlisting');
    });
    Route::get('/my-product', function () {
        return view('user.myproduct');
    });
    Route::get('/user_setting', function () {
        return view('user.usersetting');
    });
    Route::get('/detailcar', function () {
        return view('product.car_detail');
    });
    Route::get('/home', function () {
        return view('user.home');
    })->name('home');

    Route::get('/favorites', function () {
        return view('user.favorites');
    });
    Route::get('/detail_chat', function () {
        return view('user.chat_detail');
    });
    Route::get('/product-detail/chatsale/{id_saller}/{id_user}', [ChatController::class, 'getMessages']);
});




Route::controller(GoogleController::class)->group(function () {
    Route::middleware('web')->get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogle');
});
