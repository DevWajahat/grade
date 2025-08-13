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
    Route::post('submit-exam/{id}','submitExam')->name('submitexam');
});

Route::controller(CameraController::class)->group(function () {
    Route::get('camera/{index}/{id}','index')->name('camera');
    Route::post('ocr/{index}/{id}','ocr')->name('ocr');
});
