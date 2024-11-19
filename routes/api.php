<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Mobile routes

Route::prefix('mobile')->group(function () {

    Route::post('/login', [AuthController::class, 'mobileLogin']);
    Route::post('/register', [AuthController::class, 'mobileRegister']);
});
