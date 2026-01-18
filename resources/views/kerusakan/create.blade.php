@extends('layouts.sidebar')

@section('title', 'Tambah Kerusakan - Sistem Pakar Motor')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-10">
        <div class="px-8 py-6">
            <h1 class="text-3xl font-bold text-white">
                <i class="fas fa-plus text-green-400 mr-3"></i>Tambah Kerusakan Baru
            </h1>
            <p class="text-gray-400 mt-1">Tambahkan data kerusakan dan solusi perbaikan motor</p>
        </div>
    </header>

    <!-- Main Content -->
    <div class="p-8">
        <div class="max-w-2xl">
            <form action="{{ route('kerusakan.store') }}" method="POST"
                  class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg p-8">
                @csrf

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-900/50 border border-red-700 rounded-lg">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle text-red-400 mr-2"></i>
                            <p class="text-red-200 font-medium">Terjadi kesalahan:</p>
                        </div>
                        <ul class="text-red-200 text-sm space-y-1 ml-6">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-6">
                    <!-- Kode Kerusakan -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-barcode text-green-400 mr-2"></i>Kode Kerusakan
                        </label>
                        <input type="text" name="kode_kerusakan" required
                               placeholder="Contoh: K01"
                               value="{{ old('kode_kerusakan') }}"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                      placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500
                                      focus:border-green-500 transition">
                        @error('kode_kerusakan')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Kerusakan -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-tag text-green-400 mr-2"></i>Nama Kerusakan
                        </label>
                        <input type="text" name="nama_kerusakan" required
                               placeholder="Masukkan nama kerusakan"
                               value="{{ old('nama_kerusakan') }}"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                      placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500
                                      focus:border-green-500 transition">
                        @error('nama_kerusakan')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Solusi -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-wrench text-green-400 mr-2"></i>Solusi Perbaikan
                        </label>
                        <textarea name="solusi" rows="5"
                                  placeholder="Jelaskan cara memperbaiki kerusakan ini secara detail"
                                  class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                         placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500
                                         focus:border-green-500 transition resize-none">{{ old('solusi') }}</textarea>
                        @error('solusi')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4 border-t border-gray-700">
                        <button type="submit"
                                class="flex-1 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium
                                       rounded-lg transition shadow-lg hover:shadow-green-500/20">
                            <i class="fas fa-save mr-2"></i> Simpan Data
                        </button>
                        <a href="{{ route('kerusakan.index') }}"
                           class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white font-medium
                                  rounded-lg transition">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
