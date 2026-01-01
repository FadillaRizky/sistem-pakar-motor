@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Sistem Pakar Diagnosa Motor</h1>
            <p class="text-lg text-gray-600">Pilih gejala yang Anda alami untuk mendapatkan diagnosa kerusakan motor</p>
        </div>

        <!-- Form Konsultasi -->
        <form action="{{ route('konsultasi.proses') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
            @csrf

            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Pilih Gejala</h2>

                @if ($errors->has('gejala_ids'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ $errors->first('gejala_ids') }}
                    </div>
                @endif

                <div class="space-y-3">
                    @forelse($gejalas as $gejala)
                    <div class="flex items-start">
                        <input
                            type="checkbox"
                            name="gejala_ids[]"
                            value="{{ $gejala->id }}"
                            id="gejala_{{ $gejala->id }}"
                            class="mt-1 h-5 w-5 text-blue-600 rounded focus:ring-blue-500 cursor-pointer"
                        >
                        <label for="gejala_{{ $gejala->id }}" class="ml-3 cursor-pointer">
                            <div class="font-medium text-gray-800">{{ $gejala->kode_gejala }} - {{ $gejala->nama_gejala }}</div>
                            <div class="text-sm text-gray-600">{{ $gejala->deskripsi }}</div>
                        </label>
                    </div>
                    @empty
                    <p class="text-gray-500">Tidak ada gejala yang tersedia</p>
                    @endforelse
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex gap-4">
                <button
                    type="submit"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200"
                >
                    Mulai Diagnosa
                </button>
                <a
                    href="/"
                    class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-200 text-center"
                >
                    Kembali
                </a>
            </div>
        </form>

        <!-- Info Box -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="font-semibold text-blue-900 mb-2">💡 Informasi Penting</h3>
            <p class="text-blue-800 text-sm">
                Sistem ini menggunakan metode Forward Chaining untuk mendiagnosa kerusakan motor berdasarkan gejala yang Anda pilih.
                Semakin banyak gejala yang Anda pilih, semakin akurat hasil diagnosa.
            </p>
        </div>
    </div>
</div>
@endsection
