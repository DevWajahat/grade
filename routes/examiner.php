<?php

use App\Http\Controllers\Examiner\ExamController;
use App\Http\Controllers\Examiner\HallController;
use App\Http\Controllers\Examiner\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [IndexController::class, 'index'])->name('index');

Route::prefix('halls')->controller(HallController::class)->name('hall.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::post('update/{id}', 'update')->name('update');
    Route::get('hall-candidates/{id}','hallCandidates')->name('candidates');
});

Route::prefix('exams')->controller(ExamController::class)->name('exams.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('update/{id}', 'update')->name('update');
    Route::get('/{id}/data',  'getExamData')->name('.data');
    Route::post('update-exam-status', 'updateExamStatus')->name('status.update');
    Route::get('exam-result/{id}', 'result')->name('result');
    Route::get('candidate-result-detail/{id}','candidateResult')->name('candidate.result');
});
