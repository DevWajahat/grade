<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\IndexController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [IndexController::class, 'index'])->name('index')->middleware('guest');

Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('register', 'register_view')->name('register');
    Route::post('register', 'register');
    Route::get('login', 'login_view')->name('login');
    Route::post('login', 'login');
});
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
