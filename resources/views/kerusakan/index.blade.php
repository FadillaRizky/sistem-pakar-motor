@extends('layouts.sidebar')

@section('title', 'Data Kerusakan - Sistem Pakar Motor')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-10">
        <div class="px-8 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    <i class="fas fa-exclamation-triangle text-green-400 mr-3"></i>Data Kerusakan
                </h1>
                <p class="text-gray-400 mt-1">Kelola data kerusakan dan solusi perbaikan motor</p>
            </div>
            <a href="{{ route('kerusakan.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition shadow-lg hover:shadow-green-500/20">
                <i class="fas fa-plus mr-2"></i> Tambah Kerusakan
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
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Kode Kerusakan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nama Kerusakan</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Solusi</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($kerusakans as $item)
                            <tr class="hover:bg-gray-800 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-white">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-green-400 font-mono font-medium">{{ $item->kode_kerusakan }}</span>
                                </td>
                                <td class="px-6 py-4 text-white font-medium">{{ $item->nama_kerusakan }}</td>
                                <td class="px-6 py-4 text-gray-400 text-sm max-w-md">{{ Str::limit($item->solusi, 100) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                    <a href="{{ route('kerusakan.edit', $item->id) }}"
                                       class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('kerusakan.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus data ini?')"
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
                                    <p class="text-gray-400">Belum ada data kerusakan</p>
                                    <a href="{{ route('kerusakan.create') }}" class="text-green-400 hover:text-green-300 text-sm mt-2 inline-block">
                                        + Tambah Kerusakan Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($kerusakans->hasPages())
                <div class="bg-gray-800 px-6 py-4 border-t border-gray-700">
                    {{ $kerusakans->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
