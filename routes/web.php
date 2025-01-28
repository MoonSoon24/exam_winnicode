<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ExamController;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/exam', function () {
    return view('exam');
})->name('exam');

Route::get('/exams/{id}/start', [ExamController::class, 'startExam']);
