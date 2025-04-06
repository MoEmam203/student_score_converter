<?php

use App\Http\Controllers\StudentScoreConverterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/student-score-converter', [StudentScoreConverterController::class, 'index'])->name('student-score-converter.index');
