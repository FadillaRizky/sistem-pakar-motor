@extends('layouts.sidebar')

@section('title', 'Detail Rule - Sistem Pakar Motor')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-10">
        <div class="px-8 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    <i class="fas fa-eye text-purple-400 mr-3"></i>Detail Rule
                </h1>
                <p class="text-gray-400 mt-1">Informasi lengkap tentang aturan diagnosa</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('rule.edit', $rule->id) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition shadow-lg hover:shadow-blue-500/20">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('rule.index') }}"
                   class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="p-8 space-y-6">
        @php
            $gejalaIds = is_array($rule->gejala_ids) ? $rule->gejala_ids : json_decode($rule->gejala_ids, true);
            $gejalaList = collect($gejalas)->whereIn('id', $gejalaIds)->toArray();
        @endphp

        <!-- Kerusakan Card -->
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700 bg-green-900/20">
                <h2 class="text-xl font-bold text-green-400">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Informasi Kerusakan
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-400 text-sm font-medium mb-2">Kode Kerusakan</label>
                        <p class="text-green-400 text-2xl font-bold font-mono">{{ $rule->kerusakan->kode_kerusakan }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm font-medium mb-2">Nama Kerusakan</label>
                        <p class="text-white text-lg font-semibold">{{ $rule->kerusakan->nama_kerusakan }}</p>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-gray-400 text-sm font-medium mb-2">Solusi Perbaikan</label>
                        <p class="text-gray-300 leading-relaxed bg-gray-800 p-4 rounded-lg border border-gray-700">{{ $rule->kerusakan->solusi }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gejala Card -->
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700 bg-blue-900/20">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-blue-400">
                        <i class="fas fa-list-ul mr-2"></i>Gejala yang Terkait
                    </h2>
                    <span class="bg-purple-600 text-white px-4 py-2 rounded-lg font-bold">{{ count($gejalaList) }} Gejala</span>
                </div>
            </div>
            <div class="p-6">
                @if(count($gejalaList) > 0)
                    <div class="grid gap-4">
                        @foreach($gejalaList as $gejala)
                            <div class="bg-gray-800 p-4 rounded-lg border-l-4 border-blue-500 hover:bg-gray-750 transition">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="bg-blue-600 text-white px-3 py-1 rounded font-mono font-bold text-sm">{{ $gejala['kode_gejala'] }}</span>
                                            <span class="text-white font-semibold">{{ $gejala['nama_gejala'] }}</span>
                                        </div>
                                        <p class="text-gray-400 text-sm">{{ $gejala['deskripsi'] }}</p>
                                    </div>
                                    <span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-xs font-semibold border border-blue-500/30">
                                        Gejala
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 bg-yellow-900/20 border border-yellow-700 rounded-lg text-center">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-3xl mb-3"></i>
                        <p class="text-yellow-200 font-medium">Tidak ada gejala yang terkait dengan rule ini</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Certainty Factor Card -->
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700 bg-yellow-900/20">
                <h2 class="text-xl font-bold text-yellow-400">
                    <i class="fas fa-percent mr-2"></i>Tingkat Kepercayaan (Certainty Factor)
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-sm font-medium mb-3">Nilai CF</label>
                        <p class="text-yellow-400 text-4xl font-bold">{{ number_format($rule->certainty_factor, 2) }}</p>
                    </div>
                    <div class="bg-gray-800 p-6 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-sm font-medium mb-3">Interpretasi</label>
                        <div class="flex items-center gap-3">
                            @if($rule->certainty_factor >= 0.9)
                                <span class="w-4 h-4 bg-red-500 rounded-full"></span>
                                <span class="text-red-400 text-xl font-bold">Sangat Yakin</span>
                            @elseif($rule->certainty_factor >= 0.7)
                                <span class="w-4 h-4 bg-orange-500 rounded-full"></span>
                                <span class="text-orange-400 text-xl font-bold">Yakin</span>
                            @elseif($rule->certainty_factor >= 0.5)
                                <span class="w-4 h-4 bg-yellow-500 rounded-full"></span>
                                <span class="text-yellow-400 text-xl font-bold">Cukup</span>
                            @else
                                <span class="w-4 h-4 bg-gray-500 rounded-full"></span>
                                <span class="text-gray-400 text-xl font-bold">Rendah</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm font-medium mb-3">Progress Bar</label>
                    <div class="w-full bg-gray-800 rounded-full h-10 overflow-hidden border border-gray-700">
                        <div class="bg-gradient-to-r from-yellow-500 to-red-500 h-full rounded-full flex items-center justify-center transition-all duration-500"
                             style="width: {{ $rule->certainty_factor * 100 }}%">
                            <span class="text-white font-bold">{{ number_format($rule->certainty_factor * 100, 0) }}%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
                    <p class="text-gray-400 text-sm font-medium mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Keterangan:
                    </p>
                    <ul class="text-gray-300 text-sm space-y-1 ml-6">
                        <li>1.0 = Pasti / Definite</li>
                        <li>0.9 = Hampir Pasti / Almost Certain</li>
                        <li>0.7 = Kemungkinan Besar / Probable</li>
                        <li>0.5 = Mungkin / Possible</li>
                        <li>&lt;0.5 = Kemungkinan Kecil / Unlikely</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- System Info Card -->
        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-700 bg-gray-700/30">
                <h2 class="text-xl font-bold text-gray-300">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Sistem
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-sm font-medium mb-2">ID Rule</label>
                        <p class="text-white font-mono text-lg">#{{ $rule->id }}</p>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-sm font-medium mb-2">Status</label>
                        <span class="inline-flex items-center gap-2 bg-green-500/20 text-green-400 px-4 py-2 rounded-lg font-semibold border border-green-500/30">
                            <i class="fas fa-check-circle"></i> Aktif
                        </span>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-sm font-medium mb-2">Dibuat</label>
                        <p class="text-gray-300">{{ $rule->created_at->format('d/m/Y H:i:s') }}</p>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
                        <label class="block text-gray-400 text-sm font-medium mb-2">Diperbarui</label>
                        <p class="text-gray-300">{{ $rule->updated_at->format('d/m/Y H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center gap-4">
            <a href="{{ route('rule.index') }}"
               class="flex-1 px-6 py-4 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded-lg transition text-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
            <div class="flex gap-3">
                <a href="{{ route('rule.edit', $rule->id) }}"
                   class="px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition shadow-lg hover:shadow-blue-500/20">
                    <i class="fas fa-edit mr-2"></i> Edit Rule
                </a>
                <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin ingin menghapus rule ini secara permanen?')"
                            class="px-6 py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition shadow-lg hover:shadow-red-500/20">
                        <i class="fas fa-trash mr-2"></i> Hapus Rule
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
