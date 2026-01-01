@extends('layouts.app')

@section('content')
<div class="flex-1">
    {{-- Top bar --}}
    <header class="border-b border-slate-800 bg-slate-900/70 backdrop-blur sticky top-0 z-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-14">
            <div class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-lg bg-blue-500 flex items-center justify-center text-sm font-bold">
                    SP
                </div>
                <span class="font-semibold text-sm sm:text-base">Sistem Pakar Motor</span>
            </div>
            <div class="flex items-center gap-3 text-xs sm:text-sm">
                <span class="hidden sm:inline-block text-slate-300">
                    Halo, {{ Auth::user()->name }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex items-center gap-1 rounded-full border border-red-500/60 px-3 py-1 text-xs sm:text-sm text-red-200 hover:bg-red-500/10 transition"
                    >
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        {{-- Welcome --}}
        <section class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">
                Selamat Datang, {{ Auth::user()->name }} 👋
            </h1>
            <p class="mt-2 text-sm sm:text-base text-slate-300 max-w-xl">
                Gunakan sistem pakar untuk mendiagnosa kerusakan motor dengan cepat dan akurat.
            </p>
        </section>

        {{-- Top cards --}}
        <section class="grid gap-4 sm:gap-6 md:grid-cols-2 mb-6 sm:mb-8">
            {{-- Mulai konsultasi --}}
            <div class="rounded-2xl bg-gradient-to-br from-blue-600 to-indigo-600 p-4 sm:p-6 shadow-lg shadow-blue-900/40">
                <h2 class="text-lg sm:text-xl font-semibold mb-2">Mulai Konsultasi</h2>
                <p class="text-sm sm:text-base text-blue-100 mb-4">
                    Lakukan diagnosa kerusakan motor berdasarkan gejala yang Anda rasakan.
                </p>
                <a href="{{ route('konsultasi.index') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-white/10 hover:bg-white/20
                          text-sm sm:text-base font-semibold px-4 py-2 transition">
                    Mulai Sekarang
                    <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-white text-blue-600 text-xs">
                        →
                    </span>
                </a>
            </div>

            {{-- Cara kerja --}}
            <div class="rounded-2xl bg-gradient-to-br from-fuchsia-600 to-purple-600 p-4 sm:p-6 shadow-lg shadow-fuchsia-900/40">
                <h2 class="text-lg sm:text-xl font-semibold mb-3">Cara Kerja</h2>
                <ol class="space-y-2 text-xs sm:text-sm text-fuchsia-100">
                    <li>1. Pilih gejala yang Anda alami.</li>
                    <li>2. Sistem menganalisis dengan algoritma forward chaining.</li>
                    <li>3. Hasil diagnosa dan tingkat keyakinan ditampilkan.</li>
                    <li>4. Tersedia solusi perbaikan yang disarankan.</li>
                </ol>
            </div>
        </section>

        {{-- Bottom grid --}}
        <section class="grid gap-4 sm:gap-6 md:grid-cols-2">
            {{-- Statistik --}}
            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-4 sm:p-6">
                <h3 class="text-base sm:text-lg font-semibold mb-4">Statistik</h3>
                <dl class="grid grid-cols-3 gap-3 text-center text-xs sm:text-sm">
                    <div class="rounded-xl bg-slate-800/80 p-3">
                        <dt class="text-slate-400 mb-1">Total Gejala</dt>
                        <dd class="text-lg sm:text-2xl font-bold text-blue-400">
                            {{ $totalGejala ?? 0 }}
                        </dd>
                    </div>
                    <div class="rounded-xl bg-slate-800/80 p-3">
                        <dt class="text-slate-400 mb-1">Total Kerusakan</dt>
                        <dd class="text-lg sm:text-2xl font-bold text-emerald-400">
                            {{ $totalKerusakan ?? 0 }}
                        </dd>
                    </div>
                    <div class="rounded-xl bg-slate-800/80 p-3">
                        <dt class="text-slate-400 mb-1">Total Rules</dt>
                        <dd class="text-lg sm:text-2xl font-bold text-violet-400">
                            {{ $totalRules ?? 0 }}
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Informasi --}}
            <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-4 sm:p-6">
                <h3 class="text-base sm:text-lg font-semibold mb-3">Informasi</h3>
                <ul class="space-y-2 text-xs sm:text-sm text-slate-300">
                    <li>Sistem ini menggunakan teknologi expert system.</li>
                    <li>Hasil diagnosa adalah rekomendasi, konsultasikan dengan mekanik profesional.</li>
                    <li>Akurasi diagnosa dipengaruhi kelengkapan gejala yang dipilih.</li>
                </ul>
            </div>
        </section>

        <footer class="mt-8 text-center text-[11px] sm:text-xs text-slate-500">
            © {{ date('Y') }} Sistem Pakar Motor. All rights reserved.
        </footer>
    </main>
</div>
@endsection
