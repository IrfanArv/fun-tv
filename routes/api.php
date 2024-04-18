<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', Api\RegisterController::class)->name('api.register');
Route::post('/login', Api\LoginController::class)->name('api.login');
Route::post('/username-check', Api\UserCheckController::class)->name('api.username_check');
Route::post('/logout', Api\LogoutController::class)->name('api.logout');

// Middleware protected route
Route::middleware('auth:api')->get('/profile', function (Request $request) {
    return $request->user();
});
