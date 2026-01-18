<?php

use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::get('/', [KonsultasiController::class, 'indexPublic'])->name('home');
Route::get('/konsultasi', [KonsultasiController::class, 'indexPublic'])->name('konsultasi.public');
Route::post('/konsultasi/proses', [KonsultasiController::class, 'prosesPublic'])->name('konsultasi.public.proses');

/*
|--------------------------------------------------------------------------
| Admin Routes (Butuh Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('gejala', GejalaController::class);
    Route::resource('kerusakan', KerusakanController::class);
    Route::resource('rule', RuleController::class);
    Route::resource('motor', MotorController::class);
});

require __DIR__.'/auth.php';

