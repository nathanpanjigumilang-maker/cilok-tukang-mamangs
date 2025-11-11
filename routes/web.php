<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

// Kelas Routes
Route::resource('classes', ClassController::class);

// Siswa Routes
Route::resource('students', StudentController::class);

// Absensi Routes
Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
Route::get('/attendances/report', [AttendanceController::class, 'report'])->name('attendances.report');