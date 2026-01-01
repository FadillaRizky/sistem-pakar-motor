@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    {{-- Header --}}
    <div class="mb-6 sm:mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">
            Dashboard Admin
        </h1>
        <p class="text-slate-300 text-sm sm:text-base">
            Kelola data gejala, kerusakan, dan rule sistem pakar motor.
        </p>
    </div>

    {{-- Kartu utama --}}
    <section class="grid gap-4 sm:gap-6 md:grid-cols-3 mb-6 sm:mb-8">
        {{-- Total User (tanpa link) --}}
        <div class="rounded-2xl bg-slate-900/70 border border-slate-700 p-4 sm:p-6 shadow">
            <h2 class="text-sm font-semibold text-slate-300 mb-2">Total User</h2>
            <p class="text-2xl sm:text-3xl font-bold text-blue-400">
                {{ $totalUsers ?? 0 }}
            </p>
            <p class="mt-1 text-xs text-slate-400">
                Jumlah akun terdaftar di sistem.
            </p>
        </div>

        {{-- Total Gejala --}}
        <div class="rounded-2xl bg-slate-900/70 border border-slate-700 p-4 sm:p-6 shadow">
            <h2 class="text-sm font-semibold text-slate-300 mb-2">Total Gejala</h2>
            <p class="text-2xl sm:text-3xl font-bold text-emerald-400">
                {{ $totalGejala ?? 0 }}
            </p>
            <p class="mt-1 text-xs text-slate-400">
                Data gejala yang digunakan dalam diagnosa.
            </p>
        </div>

        {{-- Total Kerusakan --}}
        <div class="rounded-2xl bg-slate-900/70 border border-slate-700 p-4 sm:p-6 shadow">
            <h2 class="text-sm font-semibold text-slate-300 mb-2">Total Kerusakan</h2>
            <p class="text-2xl sm:text-3xl font-bold text-rose-400">
                {{ $totalKerusakan ?? 0 }}
            </p>
            <p class="mt-1 text-xs text-slate-400">
                Data kerusakan yang dapat terdiagnosa.
            </p>
        </div>
    </section>

    {{-- Aksi cepat --}}
    <section class="grid gap-4 sm:gap-6 md:grid-cols-3">
        <a href="{{ route('gejala.index') }}"
           class="rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 p-4 sm:p-6 shadow-lg shadow-blue-900/40 block">
            <h3 class="text-base sm:text-lg font-semibold mb-2 text-white">
                Kelola Gejala
            </h3>
            <p class="text-xs sm:text-sm text-blue-100">
                Tambah, ubah, dan hapus data gejala yang digunakan dalam proses diagnosa.
            </p>
        </a>

        <a href="{{ route('kerusakan.index') }}"
           class="rounded-2xl bg-gradient-to-br from-emerald-600 to-teal-600 p-4 sm:p-6 shadow-lg shadow-emerald-900/40 block">
            <h3 class="text-base sm:text-lg font-semibold mb-2 text-white">
                Kelola Kerusakan
            </h3>
            <p class="text-xs sm:text-sm text-emerald-100">
                Kelola daftar kerusakan beserta solusi perbaikannya.
            </p>
        </a>

        <a href="{{ route('rule.index') }}"
           class="rounded-2xl bg-gradient-to-br from-violet-600 to-fuchsia-600 p-4 sm:p-6 shadow-lg shadow-violet-900/40 block">
            <h3 class="text-base sm:text-lg font-semibold mb-2 text-white">
                Kelola Rule
            </h3>
            <p class="text-xs sm:text-sm text-violet-100">
                Atur hubungan antara gejala dan kerusakan (basis pengetahuan).
            </p>
        </a>
    </section>
</div>
@endsection
