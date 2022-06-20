<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', 'Api\AuthController@index');
Route::get('/logout', 'Api\AuthController@logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/room', 'MainController@getRoom');
});
