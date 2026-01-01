@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Hasil Diagnosa</h1>
            <p class="text-lg text-gray-600">Berdasarkan {{ $jumlahGejalaDipilih }} gejala yang Anda pilih</p>
        </div>

        @if($hasilTop)
            <!-- Hasil Utama (Confidence Tertinggi) -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-lg p-8 mb-8">
                <div class="mb-4">
                    <h2 class="text-3xl font-bold mb-2">{{ $hasilTop['nama_kerusakan'] }}</h2>
                    <p class="text-blue-100">{{ $hasilTop['deskripsi'] }}</p>
                </div>

                <!-- Confidence Score -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-lg font-semibold">Tingkat Keyakinan Diagnosa</span>
                        <span class="text-3xl font-bold">{{ $hasilTop['confidence'] }}%</span>
                    </div>
                    <div class="w-full bg-blue-200 rounded-full h-4">
                        <div
                            class="bg-green-400 h-4 rounded-full"
                            style="width: {{ $hasilTop['confidence'] }}%"
                        ></div>
                    </div>
                </div>

                <!-- Solusi -->
                <div class="bg-blue-700 rounded-lg p-4">
                    <h3 class="text-xl font-bold mb-2">✓ Solusi Rekomendasi</h3>
                    <p class="text-blue-50">{{ $hasilTop['solusi'] }}</p>
                </div>
            </div>

            <!-- Gejala yang Cocok -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                    Gejala yang Cocok ({{ $hasilTop['gejala_cocok'] }}/{{ $hasilTop['total_gejala_rule'] }})
                </h3>
                <div class="space-y-2">
                    @foreach($gejalaYangDipilih as $gejalaId)
                        @php
                            $gejalaData = \App\Models\Gejala::find($gejalaId);
                        @endphp
                        @if($gejalaData)
                        <div class="flex items-center text-gray-700">
                            <span class="text-green-500 mr-3">✓</span>
                            <div>
                                <span class="font-medium">{{ $gejalaData->kode_gejala }}</span> - {{ $gejalaData->nama_gejala }}
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Diagnosa Alternatif -->
            @if(count($semuaHasil) > 1)
            <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Diagnosa Alternatif</h3>
                <div class="space-y-4">
                    @foreach($semuaHasil as $key => $hasil)
                        @if($key > 0) <!-- Skip hasil pertama karena sudah ditampilkan -->
                        <div class="border-l-4 border-blue-400 pl-4 py-2">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $hasil['nama_kerusakan'] }}</h4>
                                    <p class="text-sm text-gray-600">{{ $hasil['deskripsi'] }}</p>
                                </div>
                                <span class="font-bold text-blue-600 text-lg">{{ $hasil['confidence'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div
                                    class="bg-blue-400 h-2 rounded-full"
                                    style="width: {{ $hasil['confidence'] }}%"
                                ></div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        @else
            <!-- Jika tidak ada hasil -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 text-center">
                <h3 class="text-2xl font-semibold text-yellow-900 mb-2">Tidak Ada Diagnosa</h3>
                <p class="text-yellow-800 mb-4">
                    Kombinasi gejala yang Anda pilih tidak sesuai dengan data yang ada dalam sistem.
                </p>
                <a
                    href="{{ route('konsultasi.index') }}"
                    class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200"
                >
                    Coba Lagi
                </a>
            </div>
        @endif

        <!-- Tombol Aksi -->
        <div class="flex gap-4 mt-8">
            <a
                href="{{ route('konsultasi.index') }}"
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 text-center"
            >
                Konsultasi Baru
            </a>
            <a
                href="/"
                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-200 text-center"
            >
                Kembali ke Home
            </a>
        </div>
    </div>
</div>
@endsection
