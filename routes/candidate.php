<?php

use App\Http\Controllers\Candidate\CameraController;
use App\Http\Controllers\Candidate\DashboardController;
use App\Http\Controllers\Candidate\ExamController;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
    Route::post('joinHall', 'join_hall')->name('join.hall');
    Route::get('examination/{code}', 'examination')->name('examination');
});


Route::controller(ExamController::class)->group(function () {
    Route::get('exam/{id}', 'index')->name('exam.index');
});

Route::controller(CameraController::class)->group(function () {
    Route::get('camera/{index}','index')->name('camera.index');
    Route::post('ocr/{index}','ocr')->name('ocr');
});
