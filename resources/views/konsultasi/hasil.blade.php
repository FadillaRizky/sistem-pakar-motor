@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-white mb-2">Hasil Diagnosa</h1>
    <p class="text-gray-400">Hasil analisis kerusakan motor berdasarkan gejala yang Anda pilih</p>
</div>

@if($hasil)
    <!-- Result Card -->
    <div class="bg-gradient-to-r from-green-900 to-green-800 rounded-lg shadow-lg overflow-hidden mb-6 border-l-4 border-green-500">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-green-100 mb-4">
                <i class="fas fa-check-circle"></i> Diagnosis Kerusakan
            </h2>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-green-200 text-sm font-semibold mb-2">Kode Kerusakan</label>
                    <p class="text-white text-xl font-bold">{{ $hasil->kode_kerusakan }}</p>
                </div>

                <div>
                    <label class="block text-green-200 text-sm font-semibold mb-2">Nama Kerusakan</label>
                    <p class="text-white text-lg">{{ $hasil->nama_kerusakan }}</p>
                </div>

                <div class="col-span-2">
                    <label class="block text-green-200 text-sm font-semibold mb-2">Deskripsi</label>
                    <p class="text-gray-100 leading-relaxed">{{ $hasil->deskripsi }}</p>
                </div>

                <div class="col-span-2">
                    <label class="block text-green-200 text-sm font-semibold mb-2">Solusi/Cara Perbaikan</label>
                    <p class="text-gray-100 leading-relaxed">{{ $hasil->solusi }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Confidence Score -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <!-- Persentase -->
        <div class="bg-gray-900 p-6 rounded-lg border border-gray-700">
            <label class="block text-gray-400 text-sm font-semibold mb-2">Tingkat Kepercayaan</label>
            <div class="flex items-baseline">
                <span class="text-4xl font-bold text-yellow-400">{{ number_format($persentase, 1) }}%</span>
            </div>
            <div class="mt-4 bg-gray-800 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 h-full"
                     style="width: {{ $persentase }}%"></div>
            </div>
            <p class="text-gray-400 text-xs mt-2">
                @if($persentase >= 80)
                    <span class="text-green-400">✓ Sangat Akurat</span>
                @elseif($persentase >= 60)
                    <span class="text-blue-400">✓ Akurat</span>
                @elseif($persentase >= 40)
                    <span class="text-yellow-400">⚠ Cukup Akurat</span>
                @else
                    <span class="text-red-400">✗ Kurang Akurat</span>
                @endif
            </p>
        </div>

        <!-- Gejala Dipilih -->
        <div class="bg-gray-900 p-6 rounded-lg border border-gray-700">
            <label class="block text-gray-400 text-sm font-semibold mb-2">Total Gejala Dipilih</label>
            <div class="text-4xl font-bold text-blue-400">{{ $jumlahGejalaDipilih }}</div>
            <p class="text-gray-400 text-xs mt-3">Gejala yang Anda pilih</p>
        </div>

        <!-- Gejala Cocok -->
        <div class="bg-gray-900 p-6 rounded-lg border border-gray-700">
            <label class="block text-gray-400 text-sm font-semibold mb-2">Gejala Cocok</label>
            <div class="text-4xl font-bold text-green-400">{{ count($gejalaCocok) }}</div>
            <p class="text-gray-400 text-xs mt-3">Dari kerusakan yang terdeteksi</p>
        </div>
    </div>

    <!-- Gejala Section -->
    <div class="bg-gray-900 p-6 rounded-lg border border-gray-700 mb-6">
        <h3 class="text-xl font-bold text-blue-400 mb-4">
            <i class="fas fa-list-check"></i> Detail Gejala
        </h3>

        <div class="grid grid-cols-1 gap-3 max-h-64 overflow-y-auto">
            @php
                $allGejalas = \App\Models\Gejala::whereIn('id', $userGejala)->get();
            @endphp

            @foreach($allGejalas as $gejala)
                <div class="p-4 bg-gray-800 rounded-lg border-l-4 {{ in_array($gejala->id, $gejalaCocok) ? 'border-green-500' : 'border-gray-600' }}">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="font-bold {{ in_array($gejala->id, $gejalaCocok) ? 'text-green-400' : 'text-gray-400' }}">
                                {{ $gejala->kode_gejala }}
                            </p>
                            <p class="text-white font-semibold mt-1">{{ $gejala->nama_gejala }}</p>
                            <p class="text-gray-400 text-sm mt-2">{{ $gejala->deskripsi }}</p>
                        </div>
                        <span class="ml-3 px-3 py-1 rounded-full text-xs font-semibold whitespace-nowrap
                                   {{ in_array($gejala->id, $gejalaCocok) ? 'bg-green-500 text-white' : 'bg-gray-700 text-gray-300' }}">
                            {{ in_array($gejala->id, $gejalaCocok) ? '✓ Cocok' : '○ Dipilih' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@else
    <!-- No Result Card -->
    <div class="bg-yellow-900 border border-yellow-700 rounded-lg p-6 mb-6">
        <h3 class="text-xl font-bold text-yellow-200 mb-2">
            <i class="fas fa-exclamation-triangle"></i> Diagnosa Tidak Ditemukan
        </h3>
        <p class="text-yellow-100">
            Tidak ada kerusakan yang cocok dengan gejala yang Anda pilih.
            Silakan coba lagi dengan gejala yang berbeda.
        </p>
    </div>
@endif

<!-- Action Buttons -->
<div class="flex gap-3">
    <a href="{{ route('konsultasi.index') }}"
       class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600
              text-white font-semibold rounded-lg shadow
              hover:opacity-90 transition text-center">
        <i class="fas fa-redo"></i> Diagnosa Lagi
    </a>

    <a href="javascript:history.back()"
       class="flex-1 px-6 py-3 bg-gray-700 text-white font-semibold rounded-lg shadow
              hover:bg-gray-600 transition text-center">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

@endsection
