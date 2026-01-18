@extends('layouts.sidebar')

@section('title', 'Tambah Jenis Motor - Sistem Pakar Motor')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-10">
        <div class="px-8 py-6">
            <h1 class="text-3xl font-bold text-white">
                <i class="fas fa-plus text-orange-400 mr-3"></i>Tambah Jenis Motor Baru
            </h1>
            <p class="text-gray-400 mt-1">Tambahkan data jenis motor untuk diagnosa</p>
        </div>
    </header>

    <!-- Main Content -->
    <div class="p-8">
        <div class="max-w-2xl">
            <form action="{{ route('motor.store') }}" method="POST" enctype="multipart/form-data"
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
                    <!-- Nama Motor -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-motorcycle text-orange-400 mr-2"></i>Nama Motor
                        </label>
                        <input type="text" name="nama_motor" required
                               placeholder="Contoh: Vespa Klasik, Royal Enfield Classic 350"
                               value="{{ old('nama_motor') }}"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                      placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500
                                      focus:border-orange-500 transition">
                        @error('nama_motor')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Merk -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-tag text-orange-400 mr-2"></i>Merk
                        </label>
                        <input type="text" name="merk" required
                               placeholder="Contoh: Vespa, Royal Enfield, Honda, Yamaha"
                               value="{{ old('merk') }}"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                      placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500
                                      focus:border-orange-500 transition">
                        @error('merk')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipe -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-list text-orange-400 mr-2"></i>Tipe
                        </label>
                        <input type="text" name="tipe"
                               placeholder="Contoh: Klasik, Sport, Cub"
                               value="{{ old('tipe') }}"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                      placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500
                                      focus:border-orange-500 transition">
                        @error('tipe')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Transmisi -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-cogs text-orange-400 mr-2"></i>Jenis Transmisi
                        </label>
                        <select name="transmisi" required
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                       focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                            <option value="">-- Pilih Jenis Transmisi --</option>
                            <option value="matic" {{ old('transmisi') == 'matic' ? 'selected' : '' }}>Matic</option>
                            <option value="manual" {{ old('transmisi') == 'manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                        @error('transmisi')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-align-left text-orange-400 mr-2"></i>Deskripsi
                        </label>
                        <textarea name="deskripsi" rows="3"
                                  placeholder="Jelaskan tentang motor ini..."
                                  class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                         placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500
                                         focus:border-orange-500 transition resize-none">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-image text-orange-400 mr-2"></i>Gambar Motor
                        </label>
                        <input type="file" name="gambar"
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                      placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500
                                      focus:border-orange-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg
                                      file:border-0 file:text-sm file:font-semibold file:bg-orange-600 file:text-white
                                      hover:file:bg-orange-700">
                        <p class="text-gray-400 text-xs mt-2">Format: JPEG, PNG, JPG, GIF (Maks 2MB)</p>
                        @error('gambar')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Aktif -->
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked
                               class="w-5 h-5 text-orange-600 bg-gray-700 border-gray-600 rounded focus:ring-orange-500">
                        <input type="hidden" name="is_active" value="0">
                        <label for="is_active" class="ml-3 text-white">
                            <span class="font-medium">Aktif</span>
                            <span class="text-gray-400 text-sm block">Motor dapat dipilih saat diagnosa</span>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4 border-t border-gray-700">
                        <button type="submit"
                                class="flex-1 px-6 py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium
                                       rounded-lg transition shadow-lg hover:shadow-orange-500/20">
                            <i class="fas fa-save mr-2"></i> Simpan Data
                        </button>
                        <a href="{{ route('motor.index') }}"
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
