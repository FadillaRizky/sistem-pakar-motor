@extends('layouts.sidebar')

@section('title', 'Data Rule - Sistem Pakar Motor')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-10">
        <div class="px-8 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    <i class="fas fa-project-diagram text-purple-400 mr-3"></i>Data Rule
                </h1>
                <p class="text-gray-400 mt-1">Kelola aturan diagnosa kerusakan motor</p>
            </div>
            <a href="{{ route('rule.create') }}"
               class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition shadow-lg hover:shadow-purple-500/20">
                <i class="fas fa-plus mr-2"></i> Tambah Rule
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="p-8">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-900/50 border border-green-700 rounded-lg flex items-center">
                <i class="fas fa-check-circle text-green-400 mr-3"></i>
                <p class="text-green-200">{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-800">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Kerusakan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Gejala</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">CF</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($rules as $rule)
                            <tr class="hover:bg-gray-800 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-white">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-green-400 font-mono font-medium">{{ $rule->kerusakan->kode_kerusakan }}</span>
                                    <br>
                                    <span class="text-white text-sm">{{ $rule->kerusakan->nama_kerusakan }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $gejalaIds = is_array($rule->gejala_ids) ? $rule->gejala_ids : json_decode($rule->gejala_ids, true);
                                        $gejalaNama = collect($gejalas)->whereIn('id', $gejalaIds)->pluck('nama_gejala')->toArray();
                                    @endphp

                                    @if(count($gejalaNama) > 0)
                                        <span class="inline-block bg-purple-600 text-white px-2 py-1 rounded text-xs font-medium">{{ count($gejalaIds) }} gejala</span>
                                        <br>
                                        <span class="text-gray-400 text-sm mt-1 inline-block">
                                            {{ implode(', ', array_slice($gejalaNama, 0, 2)) }}
                                            @if(count($gejalaNama) > 2)
                                                <br>+{{ count($gejalaNama) - 2 }} lainnya
                                            @endif
                                        </span>
                                    @else
                                        <span class="text-red-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-yellow-400 font-bold text-lg">{{ number_format($rule->certainty_factor, 2) }}</span>
                                    <br>
                                    <span class="text-gray-400 text-xs">
                                        @if($rule->certainty_factor >= 0.9)
                                            Sangat Yakin
                                        @elseif($rule->certainty_factor >= 0.7)
                                            Yakin
                                        @elseif($rule->certainty_factor >= 0.5)
                                            Cukup
                                        @else
                                            Rendah
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                    <a href="{{ route('rule.show', $rule->id) }}"
                                       class="inline-flex items-center px-3 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg text-sm transition">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </a>
                                    <a href="{{ route('rule.edit', $rule->id) }}"
                                       class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus rule ini?')"
                                                class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm transition">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <i class="fas fa-inbox text-gray-600 text-4xl mb-3"></i>
                                    <p class="text-gray-400">Belum ada data rule</p>
                                    <a href="{{ route('rule.create') }}" class="text-purple-400 hover:text-purple-300 text-sm mt-2 inline-block">
                                        + Tambah Rule Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($rules->hasPages())
                <div class="bg-gray-800 px-6 py-4 border-t border-gray-700">
                    {{ $rules->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
