<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;


// Web routes

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('password-reset', function () {
    return view('auth.password-reset');
})->name('password.reset');

Route::get('/token', function () {
    return csrf_token(); 
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/password-reset', [AuthController::class, 'resetPassword']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {

    // Post routes 
    Route::prefix('auth')->middleware(['auth'])->group(function () {
            Route::resource('/post', PostController::class)->except(['index']);
        Route::get('post', [PostController::class, 'index'])->name('post.index');
    });
});




