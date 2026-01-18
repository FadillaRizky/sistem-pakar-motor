@extends('layouts.sidebar')

@section('title', 'Dashboard Admin - Sistem Pakar Motor')

@section('content')
<div class="min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900/80 backdrop-blur-sm border-b border-gray-700 sticky top-0 z-10">
        <div class="px-8 py-6">
            <h1 class="text-3xl font-bold text-white">
                <i class="fas fa-tachometer-alt text-blue-400 mr-3"></i>Dashboard
            </h1>
            <p class="text-gray-400 mt-1">Selamat datang di panel admin sistem pakar motor</p>
        </div>
    </header>

    <!-- Main Content -->
    <div class="p-8">
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Gejala Card -->
            <div class="bg-gray-900 border border-gray-700 rounded-lg p-6 shadow-lg hover:shadow-blue-500/10 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm font-medium">Total Gejala</p>
                        <p class="text-4xl font-bold text-blue-400 mt-2">{{ \App\Models\Gejala::count() }}</p>
                    </div>
                    <div class="w-14 h-14 bg-blue-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-list-ul text-blue-400 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-700">
                    <a href="{{ route('gejala.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                        Kelola Data <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Kerusakan Card -->
            <div class="bg-gray-900 border border-gray-700 rounded-lg p-6 shadow-lg hover:shadow-green-500/10 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm font-medium">Total Kerusakan</p>
                        <p class="text-4xl font-bold text-green-400 mt-2">{{ \App\Models\Kerusakan::count() }}</p>
                    </div>
                    <div class="w-14 h-14 bg-green-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-green-400 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-700">
                    <a href="{{ route('kerusakan.index') }}" class="text-green-400 hover:text-green-300 text-sm font-medium">
                        Kelola Data <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Rule Card -->
            <div class="bg-gray-900 border border-gray-700 rounded-lg p-6 shadow-lg hover:shadow-purple-500/10 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm font-medium">Total Rule</p>
                        <p class="text-4xl font-bold text-purple-400 mt-2">{{ \App\Models\Rule::count() }}</p>
                    </div>
                    <div class="w-14 h-14 bg-purple-500/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-project-diagram text-purple-400 text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-700">
                    <a href="{{ route('rule.index') }}" class="text-purple-400 hover:text-purple-300 text-sm font-medium">
                        Kelola Data <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tables Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Gejala Table -->
            <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg">
                <div class="p-5 border-b border-gray-700 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-white">
                        <i class="fas fa-list-ul text-blue-400 mr-2"></i> Gejala Terbaru
                    </h2>
                    <a href="{{ route('gejala.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                        Lihat Semua
                    </a>
                </div>
                <div class="p-4">
                    @if($gejalas->count() > 0)
                        <div class="space-y-3">
                            @foreach($gejalas as $gejala)
                                <div class="bg-gray-800 rounded-lg p-3 hover:bg-gray-750 transition">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <span class="text-blue-400 text-xs font-medium">{{ $gejala->kode_gejala }}</span>
                                            <p class="text-white text-sm font-medium mt-1">{{ $gejala->nama_gejala }}</p>
                                            <p class="text-gray-400 text-xs mt-1">{{ Str::limit($gejala->deskripsi, 50) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-gray-600 text-3xl mb-2"></i>
                            <p class="text-gray-400 text-sm">Belum ada data gejala</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kerusakan Table -->
            <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg">
                <div class="p-5 border-b border-gray-700 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-white">
                        <i class="fas fa-exclamation-triangle text-green-400 mr-2"></i> Kerusakan Terbaru
                    </h2>
                    <a href="{{ route('kerusakan.index') }}" class="text-green-400 hover:text-green-300 text-sm font-medium">
                        Lihat Semua
                    </a>
                </div>
                <div class="p-4">
                    @if($kerusakans->count() > 0)
                        <div class="space-y-3">
                            @foreach($kerusakans as $kerusakan)
                                <div class="bg-gray-800 rounded-lg p-3 hover:bg-gray-750 transition">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <span class="text-green-400 text-xs font-medium">{{ $kerusakan->kode_kerusakan }}</span>
                                            <p class="text-white text-sm font-medium mt-1">{{ $kerusakan->nama_kerusakan }}</p>
                                            <p class="text-gray-400 text-xs mt-1">{{ Str::limit($kerusakan->solusi, 50) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-gray-600 text-3xl mb-2"></i>
                            <p class="text-gray-400 text-sm">Belum ada data kerusakan</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rule Table -->
            <div class="bg-gray-900 border border-gray-700 rounded-lg shadow-lg">
                <div class="p-5 border-b border-gray-700 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-white">
                        <i class="fas fa-project-diagram text-purple-400 mr-2"></i> Rule Terbaru
                    </h2>
                    <a href="{{ route('rule.index') }}" class="text-purple-400 hover:text-purple-300 text-sm font-medium">
                        Lihat Semua
                    </a>
                </div>
                <div class="p-4">
                    @if($rules->count() > 0)
                        <div class="space-y-3">
                            @foreach($rules as $rule)
                                <div class="bg-gray-800 rounded-lg p-3 hover:bg-gray-750 transition">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <span class="text-purple-400 text-xs font-medium">
                                                {{ $rule->kerusakan->kode_kerusakan ?? '-' }}
                                            </span>
                                            <p class="text-white text-sm font-medium mt-1">
                                                {{ $rule->kerusakan->nama_kerusakan ?? 'Unknown' }}
                                            </p>
                                            <p class="text-gray-400 text-xs mt-1">
                                                {{ is_array($rule->gejala_ids) ? count($rule->gejala_ids) : count(json_decode($rule->gejala_ids)) }} gejala
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-inbox text-gray-600 text-3xl mb-2"></i>
                            <p class="text-gray-400 text-sm">Belum ada data rule</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gray-900 border border-gray-700 rounded-lg p-6 shadow-lg">
            <h2 class="text-lg font-bold text-white mb-4">
                <i class="fas fa-bolt text-yellow-400 mr-2"></i> Aksi Cepat
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('gejala.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 rounded-lg text-center font-medium transition shadow-lg hover:shadow-blue-500/20">
                    <i class="fas fa-plus mr-2"></i> Tambah Gejala Baru
                </a>
                <a href="{{ route('kerusakan.create') }}"
                   class="bg-green-600 hover:bg-green-700 text-white px-6 py-4 rounded-lg text-center font-medium transition shadow-lg hover:shadow-green-500/20">
                    <i class="fas fa-plus mr-2"></i> Tambah Kerusakan Baru
                </a>
                <a href="{{ route('rule.create') }}"
                   class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-4 rounded-lg text-center font-medium transition shadow-lg hover:shadow-purple-500/20">
                    <i class="fas fa-plus mr-2"></i> Tambah Rule Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
