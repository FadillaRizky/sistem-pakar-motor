<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\KonsultasiController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('gejala', GejalaController::class);
    Route::resource('kerusakan', KerusakanController::class);
    Route::resource('rule', RuleController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// USER
Route::get('/', function () {
    return view('user.home');
});

Route::get('/konsultasi', [KonsultasiController::class, 'index'])
    ->name('konsultasi.index');

Route::post('/konsultasi/proses', [KonsultasiController::class, 'proses'])
    ->name('konsultasi.proses');


require __DIR__ . '/auth.php';
