<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;

// Route home - pakai dashboard
Route::get('/', function () {
    return view('dashboard');
});

// Class Routes
Route::resource('classes', ClassController::class);

// Student Routes  
Route::resource('students', StudentController::class);

// Attendance Routes
Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');