<?php

use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\RuleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| USER (role=user)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

     Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
    Route::post('/konsultasi/proses', [KonsultasiController::class, 'proses'])->name('konsultasi.proses');
});

/*
|--------------------------------------------------------------------------
| ADMIN (role=admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // kalau admin juga punya konsultasi sendiri
    Route::get('/admin/konsultasi', [KonsultasiController::class, 'indexAdmin'])->name('konsultasi.admin');
    Route::post('/admin/konsultasi/proses', [KonsultasiController::class, 'prosesAdmin'])->name('konsultasi.admin.proses');

    Route::resource('gejala', GejalaController::class);
    Route::resource('kerusakan', KerusakanController::class);
    Route::resource('rule', RuleController::class);
});

require __DIR__.'/auth.php';

