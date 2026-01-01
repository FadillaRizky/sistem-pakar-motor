@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-white">Edit Rule</h1>

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
        <strong>Gagal Memperbarui Rule!</strong>
        <ul class="list-disc list-inside mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="max-w-2xl">
    <form action="{{ route('rule.update', $rule->id) }}" method="POST" class="bg-gray-900 p-6 rounded-lg shadow">
        @csrf
        @method('PUT')

        <!-- Kerusakan -->
        <div class="mb-4">
            <label for="kerusakan_id" class="block text-white font-semibold mb-2">
                Pilih Kerusakan <span class="text-red-500">*</span>
            </label>
            <select name="kerusakan_id" id="kerusakan_id"
                    class="w-full px-4 py-2 bg-gray-800 text-white border rounded-lg
                           focus:border-blue-500 focus:outline-none
                           @error('kerusakan_id') border-red-500 @else border-gray-700 @enderror"
                    required>
                <option value="">-- Pilih Kerusakan --</option>
                @foreach($kerusakans as $kerusakan)
                    <option value="{{ $kerusakan->id }}" {{ $rule->kerusakan_id == $kerusakan->id ? 'selected' : '' }}>
                        {{ $kerusakan->kode_kerusakan }} - {{ $kerusakan->nama_kerusakan }}
                    </option>
                @endforeach
            </select>
            @error('kerusakan_id')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Kerusakan Info -->
        <div class="mb-4 p-3 bg-blue-900 border border-blue-700 text-blue-200 rounded-lg">
            <strong>Kerusakan Saat Ini:</strong> {{ $rule->kerusakan->nama_kerusakan }}
        </div>

        <!-- Gejala -->
        <div class="mb-4">
            <label class="block text-white font-semibold mb-2">
                Pilih Gejala (Minimum 1) <span class="text-red-500">*</span>
            </label>
            <div class="bg-gray-800 p-4 rounded-lg border border-gray-700 max-h-60 overflow-y-auto">
                @php
                    $gejalaIds = is_array($rule->gejala_ids) ? $rule->gejala_ids : json_decode($rule->gejala_ids, true);
                @endphp

                @forelse($gejalas as $gejala)
                    <div class="mb-3">
                        <label class="flex items-start cursor-pointer">
                            <input type="checkbox" name="gejala_ids[]" value="{{ $gejala->id }}"
                                   class="gejala-checkbox mt-1 w-4 h-4"
                                   {{ in_array($gejala->id, $gejalaIds) ? 'checked' : '' }}>
                            <span class="ml-3 text-white">
                                <strong>{{ $gejala->kode_gejala }}</strong> - {{ $gejala->nama_gejala }}
                                <br>
                                <span class="text-gray-400 text-sm">{{ $gejala->deskripsi }}</span>
                            </span>
                        </label>
                    </div>
                @empty
                    <p class="text-gray-400">Tidak ada gejala tersedia</p>
                @endforelse
            </div>
            <div class="text-blue-400 text-sm mt-2">
                Gejala Dipilih: <strong id="gejala-count">{{ count($gejalaIds) }}</strong>
            </div>
            @error('gejala_ids')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Certainty Factor -->
        <div class="mb-4">
            <label for="certainty_factor" class="block text-white font-semibold mb-2">
                Certainty Factor (0.0 - 1.0) <span class="text-red-500">*</span>
            </label>
            <input type="number" name="certainty_factor" id="certainty_factor"
                   class="w-full px-4 py-2 bg-gray-800 text-white border rounded-lg
                          focus:border-blue-500 focus:outline-none
                          @error('certainty_factor') border-red-500 @else border-gray-700 @enderror"
                   step="0.01" min="0" max="1" value="{{ old('certainty_factor', $rule->certainty_factor) }}" required>
            <span class="text-gray-400 text-sm">Panduan: 1.0 = Pasti, 0.9 = Hampir Pasti, 0.7 = Besar, 0.5 = Mungkin</span>
            @error('certainty_factor')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- CF Info -->
        <div class="mb-6 p-3 bg-yellow-900 border border-yellow-700 text-yellow-200 rounded-lg">
            <strong>CF Saat Ini:</strong> {{ number_format($rule->certainty_factor, 2) }}
        </div>

        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600
                           text-white font-semibold rounded-lg shadow
                           hover:opacity-90 transition">
                Perbarui Rule
            </button>
            <a href="{{ route('rule.index') }}"
               class="px-6 py-2 bg-gray-700 text-white font-semibold rounded-lg shadow
                      hover:bg-gray-600 transition">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('.gejala-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let count = document.querySelectorAll('.gejala-checkbox:checked').length;
            document.getElementById('gejala-count').textContent = count;
        });
    });
</script>

@endsection
