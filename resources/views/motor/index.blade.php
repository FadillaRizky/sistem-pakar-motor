@extends('layouts.sidebar')

@section('title', 'Data Jenis Motor - Sistem Pakar Motor')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-10">
        <div class="px-8 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">
                    <i class="fas fa-motorcycle text-orange-400 mr-3"></i>Data Jenis Motor
                </h1>
                <p class="text-gray-400 mt-1">Kelola data jenis motor untuk diagnosa</p>
            </div>
            <a href="{{ route('motor.create') }}"
               class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium transition shadow-lg hover:shadow-orange-500/20">
                <i class="fas fa-plus mr-2"></i> Tambah Motor
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
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nama Motor</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Merk</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Transmisi</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($motors as $motor)
                            <tr class="hover:bg-gray-800 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-white">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($motor->gambar)
                                        <img src="{{ asset('uploads/motor/' . $motor->gambar) }}" alt="{{ $motor->nama_motor }}" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-700 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-motorcycle text-gray-500 text-xl"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-white font-medium">{{ $motor->nama_motor }}</span>
                                    @if($motor->deskripsi)
                                        <p class="text-gray-400 text-sm mt-1">{{ Str::limit($motor->deskripsi, 50) }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-orange-400 font-medium">{{ $motor->merk }}</td>
                                <td class="px-6 py-4 text-gray-300">{{ $motor->tipe ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($motor->transmisi)
                                        <span class="px-3 py-1 {{ $motor->transmisi === 'matic' ? 'bg-blue-500/20 text-blue-400' : 'bg-purple-500/20 text-purple-400' }} rounded-full text-xs font-medium uppercase">
                                            {{ $motor->transmisi }}
                                        </span>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($motor->is_active)
                                        <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-full text-xs font-medium">Aktif</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-500/20 text-red-400 rounded-full text-xs font-medium">Non-Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                    <a href="{{ route('motor.edit', $motor->id) }}"
                                       class="inline-flex items-center px-3 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-sm transition">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('motor.destroy', $motor->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus motor ini?')"
                                                class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm transition">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <i class="fas fa-motorcycle text-gray-600 text-4xl mb-3"></i>
                                    <p class="text-gray-400">Belum ada data motor</p>
                                    <a href="{{ route('motor.create') }}" class="text-orange-400 hover:text-orange-300 text-sm mt-2 inline-block">
                                        + Tambah Motor Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($motors->hasPages())
                <div class="bg-gray-800 px-6 py-4 border-t border-gray-700">
                    {{ $motors->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
