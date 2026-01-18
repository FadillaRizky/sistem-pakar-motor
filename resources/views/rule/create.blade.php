@extends('layouts.sidebar')

@section('title', 'Tambah Rule - Sistem Pakar Motor')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-10">
        <div class="px-8 py-6">
            <h1 class="text-3xl font-bold text-white">
                <i class="fas fa-plus text-purple-400 mr-3"></i>Tambah Rule Baru
            </h1>
            <p class="text-gray-400 mt-1">Buat aturan diagnosa kerusakan motor</p>
        </div>
    </header>

    <!-- Main Content -->
    <div class="p-8">
        <div class="max-w-2xl">
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

            <form action="{{ route('rule.store') }}" method="POST"
                  class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg p-8">
                @csrf

                <div class="space-y-6">
                    <!-- Kerusakan -->
                    <div>
                        <label for="kerusakan_id" class="block text-white font-medium mb-2">
                            <i class="fas fa-exclamation-triangle text-purple-400 mr-2"></i>Pilih Kerusakan
                        </label>
                        <select name="kerusakan_id" id="kerusakan_id"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                       placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500
                                       focus:border-purple-500 transition @error('kerusakan_id') border-red-500 @enderror"
                                required>
                            <option value="">-- Pilih Kerusakan --</option>
                            @foreach($kerusakans as $kerusakan)
                                <option value="{{ $kerusakan->id }}" {{ old('kerusakan_id') == $kerusakan->id ? 'selected' : '' }}>
                                    {{ $kerusakan->kode_kerusakan }} - {{ $kerusakan->nama_kerusakan }}
                                </option>
                            @endforeach
                        </select>
                        @error('kerusakan_id')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gejala -->
                    <div>
                        <label class="block text-white font-medium mb-2">
                            <i class="fas fa-list-ul text-purple-400 mr-2"></i>Pilih Gejala (Minimum 1)
                        </label>
                        <div class="bg-gray-800 p-4 rounded-lg border border-gray-700 max-h-60 overflow-y-auto">
                            @forelse($gejalas as $gejala)
                                <div class="mb-3">
                                    <label class="flex items-start cursor-pointer">
                                        <input type="checkbox" name="gejala_ids[]" value="{{ $gejala->id }}"
                                               class="gejala-checkbox mt-1 w-4 h-4 accent-purple-500"
                                               {{ in_array($gejala->id, old('gejala_ids', [])) ? 'checked' : '' }}>
                                        <span class="ml-3">
                                            <span class="text-blue-400 font-mono">{{ $gejala->kode_gejala }}</span>
                                            <span class="text-white font-medium"> - {{ $gejala->nama_gejala }}</span>
                                            <br>
                                            <span class="text-gray-400 text-sm">{{ $gejala->deskripsi }}</span>
                                        </span>
                                    </label>
                                </div>
                            @empty
                                <p class="text-gray-400 text-center py-4">Tidak ada gejala tersedia</p>
                            @endforelse
                        </div>
                        <div class="mt-2 text-purple-400 text-sm">
                            <i class="fas fa-check-circle mr-1"></i> Gejala Dipilih: <strong id="gejala-count" class="text-white">0</strong>
                        </div>
                        @error('gejala_ids')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Certainty Factor -->
                    <div>
                        <label for="certainty_factor" class="block text-white font-medium mb-2">
                            <i class="fas fa-percent text-purple-400 mr-2"></i>Certainty Factor (0.0 - 1.0)
                        </label>
                        <input type="number" name="certainty_factor" id="certainty_factor"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                      placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500
                                      focus:border-purple-500 transition @error('certainty_factor') border-red-500 @enderror"
                               step="0.01" min="0" max="1" value="{{ old('certainty_factor', 0.95) }}" required>
                        <p class="mt-2 text-gray-400 text-sm">
                            <i class="fas fa-info-circle mr-1"></i> Panduan: 1.0 = Pasti, 0.9 = Hampir Pasti, 0.7 = Besar, 0.5 = Mungkin
                        </p>
                        @error('certainty_factor')
                            <p class="mt-2 text-red-400 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4 border-t border-gray-700">
                        <button type="submit"
                                class="flex-1 px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium
                                       rounded-lg transition shadow-lg hover:shadow-purple-500/20">
                            <i class="fas fa-save mr-2"></i> Simpan Rule
                        </button>
                        <a href="{{ route('rule.index') }}"
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.gejala-checkbox');
        const countDisplay = document.getElementById('gejala-count');

        function updateCount() {
            const count = document.querySelectorAll('.gejala-checkbox:checked').length;
            countDisplay.textContent = count;
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateCount);
        });

        // Initial count
        updateCount();
    });
</script>
@endpush
@endsection
