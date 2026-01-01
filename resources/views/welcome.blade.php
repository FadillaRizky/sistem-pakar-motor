@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
    <div class="container mx-auto px-4 py-16">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold text-gray-800 mb-4">Sistem Pakar Diagnosa Motor</h1>
            <p class="text-xl text-gray-600 mb-8">
                Bantuan cerdas untuk mendiagnosa kerusakan motor Anda dengan akurat menggunakan teknologi Expert System
            </p>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto">
            <!-- Deskripsi Sistem -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Deskripsi -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Tentang Sistem Ini</h2>
                    <p class="text-gray-700 mb-4">
                        Sistem Pakar Diagnosa Motor adalah aplikasi cerdas yang dirancang untuk membantu Anda
                        mengidentifikasi kerusakan pada motor sepeda berdasarkan gejala-gejala yang Anda alami.
                    </p>
                    <p class="text-gray-700 mb-4">
                        Menggunakan metode <strong>Forward Chaining</strong> dan <strong>Certainty Factor</strong>,
                        sistem ini memberikan diagnosa akurat dengan tingkat keyakinan yang terukur.
                    </p>
                    <p class="text-gray-600 text-sm">
                        💡 Semakin banyak gejala yang Anda pilih, semakin akurat hasil diagnosa yang Anda dapatkan.
                    </p>
                </div>

                <!-- Fitur -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Fitur Utama</h2>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-3 font-bold">✓</span>
                            <span class="text-gray-700">Diagnosa berdasarkan gejala spesifik</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-3 font-bold">✓</span>
                            <span class="text-gray-700">Menampilkan tingkat keyakinan diagnosa</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-3 font-bold">✓</span>
                            <span class="text-gray-700">Memberikan solusi rekomendasi perbaikan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-3 font-bold">✓</span>
                            <span class="text-gray-700">Menampilkan diagnosa alternatif</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-3 font-bold">✓</span>
                            <span class="text-gray-700">Interface user-friendly dan responsif</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-xl p-12 text-center mb-12">
                <h3 class="text-3xl font-bold text-white mb-4">Siap Mendiagnosa?</h3>
                <p class="text-blue-100 mb-8 text-lg">
                    Klik tombol di bawah untuk memulai konsultasi dan dapatkan diagnosa untuk motor Anda
                </p>
                <a
                    href="{{ route('konsultasi.index') }}"
                    class="inline-block bg-white text-blue-600 hover:bg-blue-50 font-bold py-4 px-12 rounded-lg transition duration-200 text-lg"
                >
                    Mulai Konsultasi Sekarang
                </a>
            </div>

            <!-- Cara Penggunaan -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Cara Penggunaan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Step 1 -->
                    <div class="text-center">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mx-auto mb-4">
                            1
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Pilih Gejala</h3>
                        <p class="text-gray-600 text-sm">
                            Pilih satu atau lebih gejala yang Anda alami pada motor Anda
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mx-auto mb-4">
                            2
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Proses Diagnosa</h3>
                        <p class="text-gray-600 text-sm">
                            Sistem akan memproses gejala Anda menggunakan logika expert system
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center">
                        <div class="bg-blue-600 text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mx-auto mb-4">
                            3
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Lihat Hasil</h3>
                        <p class="text-gray-600 text-sm">
                            Dapatkan diagnosa dengan solusi rekomendasi perbaikan
                        </p>
                    </div>
                </div>
            </div>

            <!-- Teknologi -->
            <div class="bg-blue-50 rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Teknologi yang Digunakan</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <p class="font-semibold text-gray-800">Expert System</p>
                        <p class="text-sm text-gray-600">Forward Chaining</p>
                    </div>
                    <div class="text-center">
                        <p class="font-semibold text-gray-800">Laravel</p>
                        <p class="text-sm text-gray-600">PHP Framework</p>
                    </div>
                    <div class="text-center">
                        <p class="font-semibold text-gray-800">MySQL</p>
                        <p class="text-sm text-gray-600">Database</p>
                    </div>
                    <div class="text-center">
                        <p class="font-semibold text-gray-800">Tailwind CSS</p>
                        <p class="text-sm text-gray-600">UI Framework</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
