<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hasil Diagnosa - {{ config('app.name', 'Sistem Pakar Motor') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900">
    <!-- Header / Navigation -->
    <nav class="bg-gray-900 border-b border-gray-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-motorcycle text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-white font-bold text-lg">Sistem Pakar Motor</h1>
                            <p class="text-gray-400 text-xs">Diagnosa Kerusakan Motor</p>
                        </div>
                    </a>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">
                            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium transition">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">
                    <i class="fas fa-clipboard-check text-green-400"></i>
                    Hasil Diagnosa
                </h1>
                <p class="text-gray-400">Hasil analisis kerusakan motor berdasarkan gejala yang Anda pilih</p>
            </div>

            @if($hasil && count($hasilDiagnosa) > 0)
                {{-- Selected Motor Info --}}
                @if($selectedMotor)
                    <div class="mb-6 p-4 bg-orange-900/50 border border-orange-700 rounded-lg">
                        <div class="flex items-center">
                            @if($selectedMotor->gambar)
                                <img src="{{ asset('uploads/motor/' . $selectedMotor->gambar) }}" alt="{{ $selectedMotor->nama_motor }}" class="w-20 h-20 object-cover rounded-lg mr-4">
                            @endif
                            <div>
                                <h3 class="text-orange-200 font-bold text-lg">{{ $selectedMotor->nama_motor }}</h3>
                                <p class="text-orange-100 text-sm">{{ $selectedMotor->merk }} @if($selectedMotor->tipe) - {{ $selectedMotor->tipe }}@endif</p>
                                @if($selectedMotor->deskripsi)
                                    <p class="text-orange-200/70 text-xs mt-1">{{ $selectedMotor->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Confidence Alert --}}
                <div class="mb-6 p-4 rounded-lg border @if($persentase >= 70) bg-green-900/50 border-green-700 @elseif($persentase >= 50) bg-yellow-900/50 border-yellow-700 @else bg-orange-900/50 border-orange-700 @endif">
                    <div class="flex items-start">
                        <i class="@if($persentase >= 70) fas fa-check-circle text-green-400 @elseif($persentase >= 50) fas fa-exclamation-circle text-yellow-400 @else fas fa-info-circle text-orange-400 @endif text-xl mr-3 mt-1"></i>
                        <div class="flex-1">
                            <h3 class="text-white font-bold mb-1">@if($persentase >= 70) Tingkat Kepercayaan Tinggi @elseif($persentase >= 50) Tingkat Kepercayaan Sedang @else Tingkat Kepercayaan Rendah @endif</h3>
                            <p class="text-gray-300 text-sm">
                                @if($persentase >= 70)
                                    Diagnosa ini sangat akurat. Gejala yang Anda pilih sangat cocok dengan kerusakan yang terdeteksi.
                                @elseif($persentase >= 50)
                                    Diagnosa ini cukup akurat. Disarankan untuk memeriksa kondisi motor lebih lanjut.
                                @else
                                    Diagnosa ini kurang akurat. Disarankan untuk menghubungi mekanik profesional.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Main Result Card --}}
                <div class="bg-gradient-to-r from-green-900/80 to-green-800/80 rounded-lg shadow-xl overflow-hidden mb-6 border-l-4 border-green-500">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-bold text-green-100">
                                <i class="fas fa-check-circle mr-2"></i> Diagnosis Teratas
                            </h2>
                            <span class="px-4 py-2 bg-white/20 rounded-full text-white font-bold text-lg">
                                {{ number_format($persentase, 1) }}% Cocok
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-green-200 text-sm font-semibold mb-2">Kode Kerusakan</label>
                                <p class="text-white text-2xl font-bold">{{ $hasil->kode_kerusakan }}</p>
                            </div>

                            <div>
                                <label class="block text-green-200 text-sm font-semibold mb-2">Nama Kerusakan</label>
                                <p class="text-white text-xl font-semibold">{{ $hasil->nama_kerusakan }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-green-200 text-sm font-semibold mb-2">Deskripsi Kerusakan</label>
                                <p class="text-gray-100 leading-relaxed">{{ $hasil->deskripsi }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-green-200 text-sm font-semibold mb-2">
                                    <i class="fas fa-tools mr-2"></i> Solusi / Cara Perbaikan
                                </label>
                                <div class="bg-white/10 rounded-lg p-4">
                                    <p class="text-white leading-relaxed">{{ $hasil->solusi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Statistics Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    {{-- Persentase --}}
                    <div class="bg-gray-900 p-5 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-xs font-semibold mb-2">Tingkat Kecocokan</label>
                        <div class="text-3xl font-bold text-yellow-400">{{ number_format($persentase, 1) }}%</div>
                        <div class="mt-3 bg-gray-800 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 h-full transition-all duration-500" style="width: {{ $persentase }}%"></div>
                        </div>
                    </div>

                    {{-- Gejala Dipilih --}}
                    <div class="bg-gray-900 p-5 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-xs font-semibold mb-2">Total Gejala</label>
                        <div class="text-3xl font-bold text-blue-400">{{ $jumlahGejalaDipilih }}</div>
                        <p class="text-gray-500 text-xs mt-2">Yang Anda pilih</p>
                    </div>

                    {{-- Gejala Cocok --}}
                    <div class="bg-gray-900 p-5 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-xs font-semibold mb-2">Gejala Cocok</label>
                        <div class="text-3xl font-bold text-green-400">{{ count($gejalaCocok) }}</div>
                        <p class="text-gray-500 text-xs mt-2">Dari kerusakan ini</p>
                    </div>

                    {{-- Certainty Factor --}}
                    <div class="bg-gray-900 p-5 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-xs font-semibold mb-2">Certainty Factor</label>
                        <div class="text-3xl font-bold text-purple-400">{{ number_format($certaintyFactor * 100, 0) }}%</div>
                        <p class="text-gray-500 text-xs mt-2">Kepercayaan pakar</p>
                    </div>
                </div>

                {{-- Detail Gejala --}}
                <div class="bg-gray-900 p-6 rounded-lg border border-gray-700 mb-6">
                    <h3 class="text-xl font-bold text-blue-400 mb-4">
                        <i class="fas fa-list-check mr-2"></i> Detail Gejala
                    </h3>

                    <div class="grid grid-cols-1 gap-3 max-h-80 overflow-y-auto">
                        @php
                            $allGejalas = \App\Models\Gejala::whereIn('id', $userGejala)->get();
                        @endphp

                        @foreach($allGejalas as $gejala)
                            <div class="p-4 bg-gray-800 rounded-lg border-l-4 {{ in_array($gejala->id, $gejalaCocok) ? 'border-green-500 bg-green-900/20' : 'border-gray-600' }}">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold {{ in_array($gejala->id, $gejalaCocok) ? 'text-green-400' : 'text-gray-400' }}">
                                                {{ $gejala->kode_gejala }}
                                            </span>
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold {{ in_array($gejala->id, $gejalaCocok) ? 'bg-green-500 text-white' : 'bg-gray-700 text-gray-300' }}">
                                                {{ in_array($gejala->id, $gejalaCocok) ? '✓ Cocok' : '○ Tidak Cocok' }}
                                            </span>
                                        </div>
                                        <p class="text-white font-semibold mt-2">{{ $gejala->nama_gejala }}</p>
                                        <p class="text-gray-400 text-sm mt-1">{{ $gejala->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Other Possibilities --}}
                @if(count($hasilDiagnosa) > 1)
                    <div class="bg-gray-900 p-6 rounded-lg border border-gray-700 mb-6">
                        <h3 class="text-xl font-bold text-purple-400 mb-4">
                            <i class="fas fa-lightbulb mr-2"></i> Kemungkinan Lain
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">Berikut adalah kerusakan lain yang mungkin terjadi:</p>

                        <div class="space-y-3">
                            @php
                                $otherDiagnosa = array_slice($hasilDiagnosa, 1, 3);
                            @endphp

                            @foreach($otherDiagnosa as $diagnosa)
                                <div class="bg-gray-800 rounded-lg p-4 border border-gray-700 hover:border-purple-500 transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2">
                                                <span class="text-purple-400 font-bold font-mono">{{ $diagnosa['kerusakan']->kode_kerusakan }}</span>
                                                <span class="px-2 py-0.5 bg-purple-500/20 text-purple-300 rounded text-xs font-semibold">
                                                    {{ number_format($diagnosa['persentase'], 1) }}%
                                                </span>
                                            </div>
                                            <p class="text-white font-semibold mt-1">{{ $diagnosa['kerusakan']->nama_kerusakan }}</p>
                                            <p class="text-gray-400 text-sm mt-1 line-clamp-2">{{ $diagnosa['kerusakan']->deskripsi }}</p>
                                        </div>
                                    </div>
                                    {{-- Progress bar --}}
                                    <div class="mt-3 bg-gray-700 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-purple-500 h-full" style="width: {{ $diagnosa['persentase'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Recommendations --}}
                <div class="bg-blue-900/30 border border-blue-700 rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-bold text-blue-400 mb-4">
                        <i class="fas fa-info-circle mr-2"></i> Rekomendasi Tindakan
                    </h3>
                    <ul class="space-y-2 text-gray-300">
                        @if($persentase >= 70)
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-400 mr-2 mt-1"></i>
                                <span>Lakukan perbaikan sesuai solusi yang disarankan di atas.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-400 mr-2 mt-1"></i>
                                <span>Setelah perbaikan, lakukan test drive untuk memastikan kerusakan sudah teratasi.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-400 mr-2 mt-1"></i>
                                <span>Jika masalah masih ada, pertimbangkan untuk membawa motor ke bengkel resmi.</span>
                            </li>
                        @else
                            <li class="flex items-start">
                                <i class="fas fa-wrench text-yellow-400 mr-2 mt-1"></i>
                                <span>Disarankan untuk memeriksa motor di bengkel profesional untuk diagnosis lebih akurat.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-search text-yellow-400 mr-2 mt-1"></i>
                                <span>Coba pilih gejala lain yang mungkin belum Anda pilih untuk hasil diagnosa lebih baik.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-yellow-400 mr-2 mt-1"></i>
                                <span>Jangan mengabaikan gejala yang terasa pada motor Anda.</span>
                            </li>
                        @endif
                        <li class="flex items-start">
                            <i class="fas fa-clock text-blue-400 mr-2 mt-1"></i>
                            <span>Simpan hasil diagnosa ini sebagai referensi saat ke bengkel.</span>
                        </li>
                    </ul>
                </div>

            @else
                {{-- No Result Card --}}
                <div class="bg-orange-900/50 border border-orange-700 rounded-lg p-8 mb-6 text-center">
                    <i class="fas fa-search text-orange-400 text-5xl mb-4"></i>
                    <h3 class="text-2xl font-bold text-orange-200 mb-3">
                        Diagnosa Tidak Ditemukan
                    </h3>
                    <p class="text-orange-100 mb-4">
                        Tidak ada kerusakan yang cocok dengan gejala yang Anda pilih.
                        <br>Kombinasi gejala ini mungkin belum ada di database kami.
                    </p>
                    <div class="bg-orange-800/50 rounded-lg p-4 text-left inline-block">
                        <p class="text-orange-200 text-sm font-semibold mb-2">Tips:</p>
                        <ul class="text-orange-100 text-sm space-y-1">
                            <li>• Coba pilih gejala yang lebih spesifik</li>
                            <li>• Periksa kembali gejala yang Anda alami</li>
                            <li>• Hubungi mekanik profesional untuk diagnosis manual</li>
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Action Buttons --}}
            <div class="flex gap-3">
                <a href="{{ route('home') }}"
                   class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600
                          text-white font-semibold rounded-lg shadow-lg
                          hover:opacity-90 transition text-center">
                    <i class="fas fa-redo mr-2"></i> Diagnosa Lagi
                </a>

                <button onclick="window.print()"
                        class="px-6 py-3 bg-gray-700 text-white font-semibold rounded-lg shadow-lg
                               hover:bg-gray-600 transition">
                    <i class="fas fa-print mr-2"></i> Cetak Hasil
                </button>

                <a href="javascript:history.back()"
                   class="px-6 py-3 bg-gray-800 text-white font-semibold rounded-lg shadow-lg
                          hover:bg-gray-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Sistem Pakar Motor. All rights reserved.</p>
                <p class="mt-1">Hasil diagnosa adalah rekomendasi, konsultasikan dengan mekanik profesional untuk kepastian</p>
            </div>
        </div>
    </footer>
</body>
</html>
