@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-start">
    <div>
        <h1 class="text-3xl font-bold text-white mb-2">Detail Rule</h1>
        <p class="text-gray-400">Informasi lengkap tentang rule diagnosis motor</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('rule.edit', $rule->id) }}"
           class="px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600
                  text-white font-semibold rounded-lg shadow
                  hover:opacity-90 transition">
            ✏️ Edit
        </a>
        <a href="{{ route('rule.index') }}"
           class="px-5 py-2 bg-gray-700 text-white font-semibold rounded-lg shadow
                  hover:bg-gray-600 transition">
            ← Kembali
        </a>
    </div>
</div>

<!-- Main Card -->
<div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden">

    <!-- Kerusakan Section -->
    <div class="p-6 border-b border-gray-700">
        <h2 class="text-xl font-bold text-blue-400 mb-4">
            <i class="fas fa-tools"></i> Informasi Kerusakan
        </h2>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-400 text-sm font-semibold mb-2">Kode Kerusakan</label>
                <p class="text-white text-lg font-bold">{{ $rule->kerusakan->kode_kerusakan }}</p>
            </div>

            <div>
                <label class="block text-gray-400 text-sm font-semibold mb-2">Nama Kerusakan</label>
                <p class="text-white text-lg">{{ $rule->kerusakan->nama_kerusakan }}</p>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Deskripsi</label>
                <p class="text-gray-300 leading-relaxed">{{ $rule->kerusakan->deskripsi }}</p>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Solusi/Cara Perbaikan</label>
                <p class="text-gray-300 leading-relaxed">{{ $rule->kerusakan->solusi }}</p>
            </div>
        </div>
    </div>

    <!-- Gejala Section -->
    <div class="p-6 border-b border-gray-700">
        <h2 class="text-xl font-bold text-green-400 mb-4">
            <i class="fas fa-list-check"></i> Gejala yang Terkait
        </h2>

        @php
            $gejalaIds = is_array($rule->gejala_ids) ? $rule->gejala_ids : json_decode($rule->gejala_ids, true);
            $gejalaList = collect($gejalas)->whereIn('id', $gejalaIds)->toArray();
        @endphp

        @if(count($gejalaList) > 0)
            <div class="space-y-3">
                @foreach($gejalaList as $gejala)
                    <div class="bg-gray-800 p-4 rounded-lg border-l-4 border-green-500">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="text-green-400 font-bold">{{ $gejala['kode_gejala'] }}</p>
                                <p class="text-white font-semibold mt-1">{{ $gejala['nama_gejala'] }}</p>
                                <p class="text-gray-400 text-sm mt-2">{{ $gejala['deskripsi'] }}</p>
                            </div>
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                Gejala
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 p-3 bg-blue-900 border border-blue-700 rounded-lg text-blue-200">
                <strong>Total Gejala:</strong> {{ count($gejalaList) }} gejala
            </div>
        @else
            <div class="p-4 bg-yellow-900 border border-yellow-700 rounded-lg text-yellow-200">
                <i class="fas fa-exclamation-triangle"></i> Tidak ada gejala yang terkait
            </div>
        @endif
    </div>

    <!-- Certainty Factor Section -->
    <div class="p-6 border-b border-gray-700">
        <h2 class="text-xl font-bold text-yellow-400 mb-4">
            <i class="fas fa-percent"></i> Tingkat Kepercayaan (Certainty Factor)
        </h2>

        <div class="grid grid-cols-2 gap-6">
            <div class="bg-gray-800 p-4 rounded-lg">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Nilai CF</label>
                <p class="text-yellow-400 text-3xl font-bold">{{ number_format($rule->certainty_factor, 2) }}</p>
            </div>

            <div class="bg-gray-800 p-4 rounded-lg">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Interpretasi</label>
                <p class="text-white text-lg font-semibold">
                    @if($rule->certainty_factor >= 0.9)
                        <span class="text-red-400">🔴 Sangat Yakin / Very Confident</span>
                    @elseif($rule->certainty_factor >= 0.7)
                        <span class="text-orange-400">🟠 Yakin / Confident</span>
                    @elseif($rule->certainty_factor >= 0.5)
                        <span class="text-yellow-400">🟡 Cukup / Moderate</span>
                    @else
                        <span class="text-gray-400">⚪ Rendah / Low</span>
                    @endif
                </p>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-400 text-sm font-semibold mb-3">Progress Bar</label>
                <div class="w-full bg-gray-800 rounded-full h-8 overflow-hidden border border-gray-700">
                    <div class="bg-gradient-to-r from-yellow-500 to-red-500 h-full rounded-full flex items-center justify-center"
                         style="width: {{ $rule->certainty_factor * 100 }}%">
                        <span class="text-white font-bold text-sm">{{ number_format($rule->certainty_factor * 100, 0) }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 p-3 bg-blue-900 border border-blue-700 rounded-lg text-blue-200 text-sm">
            <strong>Keterangan:</strong>
            <ul class="list-disc list-inside mt-2 space-y-1">
                <li>1.0 = Pasti / Definite</li>
                <li>0.9 = Hampir Pasti / Almost Certain</li>
                <li>0.7 = Kemungkinan Besar / Probable</li>
                <li>0.5 = Mungkin / Possible</li>
                <li>&lt;0.5 = Kemungkinan Kecil / Unlikely</li>
            </ul>
        </div>
    </div>

    <!-- System Info Section -->
    <div class="p-6">
        <h2 class="text-xl font-bold text-gray-400 mb-4">
            <i class="fas fa-info-circle"></i> Informasi Sistem
        </h2>

        <div class="grid grid-cols-2 gap-6">
            <div class="bg-gray-800 p-4 rounded-lg">
                <label class="block text-gray-400 text-sm font-semibold mb-2">ID Rule</label>
                <p class="text-white font-mono">{{ $rule->id }}</p>
            </div>

            <div class="bg-gray-800 p-4 rounded-lg">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Status</label>
                <span class="inline-block bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    ✓ Aktif
                </span>
            </div>

            <div class="bg-gray-800 p-4 rounded-lg">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Dibuat</label>
                <p class="text-gray-300">{{ $rule->created_at->format('d/m/Y H:i:s') }}</p>
            </div>

            <div class="bg-gray-800 p-4 rounded-lg">
                <label class="block text-gray-400 text-sm font-semibold mb-2">Diperbarui</label>
                <p class="text-gray-300">{{ $rule->updated_at->format('d/m/Y H:i:s') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="mt-6 flex gap-3 justify-between">
    <a href="{{ route('rule.index') }}"
       class="px-5 py-2 bg-gray-700 text-white font-semibold rounded-lg shadow
              hover:bg-gray-600 transition">
        ← Kembali ke Daftar
    </a>

    <div class="flex gap-2">
        <a href="{{ route('rule.edit', $rule->id) }}"
           class="px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600
                  text-white font-semibold rounded-lg shadow
                  hover:opacity-90 transition">
            ✏️ Edit Rule
        </a>

        <form action="{{ route('rule.destroy', $rule->id) }}"
              method="POST"
              onsubmit="return confirm('Hapus rule ini secara permanen?');"
              class="inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-5 py-2 bg-gradient-to-r from-red-500 to-red-600
                           text-white font-semibold rounded-lg shadow
                           hover:opacity-90 transition">
                🗑️ Hapus Rule
            </button>
        </form>
    </div>
</div>

@endsection
