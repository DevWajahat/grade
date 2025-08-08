<?php

use App\Http\Controllers\Candidate\DashboardController;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard','index')->name('dashboard');
    Route::post('joinHall','join_hall')->name('join.hall');
    Route::get('examination/{code}','examination')->name('examination');
});
