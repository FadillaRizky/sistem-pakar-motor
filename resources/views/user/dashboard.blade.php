@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Navigation -->
    <nav class="bg-gray-800 border-b border-gray-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-motorcycle text-blue-400 text-2xl mr-3"></i>
                    <h1 class="text-white text-xl font-bold">Sistem Pakar Motor</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-gray-300">Halo, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-semibold">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-gray-400">Gunakan sistem pakar kami untuk mendiagnosa kerusakan motor Anda dengan akurat.</p>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Konsultasi Card -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-lg shadow-lg overflow-hidden border border-blue-700 hover:border-blue-500 transition cursor-pointer"
                 onclick="window.location.href='{{ route('konsultasi.index') }}'">
                <div class="p-8">
                    <i class="fas fa-stethoscope text-blue-300 text-4xl mb-4"></i>
                    <h3 class="text-2xl font-bold text-white mb-2">Mulai Konsultasi</h3>
                    <p class="text-blue-100 mb-6">Lakukan diagnosa kerusakan motor berdasarkan gejala yang Anda rasakan.</p>
                    <div class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">
                        <i class="fas fa-arrow-right"></i> Mulai Sekarang
                    </div>
                </div>
            </div>

            <!-- How It Works Card -->
            <div class="bg-gradient-to-br from-purple-900 to-purple-800 rounded-lg shadow-lg overflow-hidden border border-purple-700">
                <div class="p-8">
                    <i class="fas fa-book text-purple-300 text-4xl mb-4"></i>
                    <h3 class="text-2xl font-bold text-white mb-4">Cara Kerja</h3>
                    <ul class="space-y-2 text-purple-100 text-sm">
                        <li><span class="bg-purple-700 rounded-full px-3 py-1 mr-2">1</span>Pilih gejala yang Anda alami</li>
                        <li><span class="bg-purple-700 rounded-full px-3 py-1 mr-2">2</span>Sistem akan menganalisis dengan algoritma forward chaining</li>
                        <li><span class="bg-purple-700 rounded-full px-3 py-1 mr-2">3</span>Dapatkan hasil diagnosa dengan tingkat akurasi</li>
                        <li><span class="bg-purple-700 rounded-full px-3 py-1 mr-2">4</span>Lihat solusi perbaikan yang disarankan</li>
                    </ul>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 p-6">
                <h3 class="text-xl font-bold text-white mb-4">Statistik</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Total Gejala</span>
                        <span class="text-2xl font-bold text-blue-400">{{ \App\Models\Gejala::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Total Kerusakan</span>
                        <span class="text-2xl font-bold text-green-400">{{ \App\Models\Kerusakan::count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Total Rules</span>
                        <span class="text-2xl font-bold text-purple-400">{{ \App\Models\Rule::count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 p-6">
                <h3 class="text-xl font-bold text-white mb-4">Informasi</h3>
                <div class="space-y-3 text-gray-300 text-sm">
                    <p>
                        <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                        Sistem ini menggunakan teknologi expert system
                    </p>
                    <p>
                        <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                        Hasil diagnosa adalah rekomendasi, konsultasikan dengan mekanik profesional
                    </p>
                    <p>
                        <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                        Akurasi diagnosis tergantung pada kelengkapan gejala yang dipilih
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 text-center text-gray-500 text-sm">
            <p>© 2026 Sistem Pakar Motor. All rights reserved.</p>
        </div>
    </div>
</div>
@endsection
