@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-white">Data Rules</h1>

<a href="{{ route('rule.create') }}"
    class="mb-4 inline-block px-5 py-2 bg-gradient-to-r from-green-500 to-green-600
              text-white font-semibold rounded-lg shadow hover:opacity-90 transition">
    + Tambah Rule
</a>

@if (session('success'))
   <div class="mb-4 p-3 bg-green-100 border border-green-300
                    text-green-800 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="overflow-x-auto">
<table class="w-full border-collapse rounded-lg overflow-hidden">
    <thead class="bg-blue-800 text-white">
        <tr>
            <th class="p-3 text-center border border-blue-700">No</th>
            <th class="p-3 text-center border border-blue-700">Kerusakan</th>
            <th class="p-3 text-center border border-blue-700">Gejala</th>
            <th class="p-3 text-center border border-blue-700">CF</th>
            <th class="p-3 text-center border border-blue-700">Aksi</th>
        </tr>
    </thead>
    <tbody class="text-white">
        @forelse ($rules as $rule)
        <tr>
            <td class="p-3 border text-center">{{ $loop->iteration }}</td>
            <td class="p-3 border">
                <strong>{{ $rule->kerusakan->kode_kerusakan }}</strong>
                <br>
                <span class="text-gray-300">{{ $rule->kerusakan->nama_kerusakan }}</span>
            </td>
            <td class="p-3 border">
                @php
                    $gejalaIds = is_array($rule->gejala_ids) ? $rule->gejala_ids : json_decode($rule->gejala_ids, true);
                    $gejalaNama = collect($gejalas)->whereIn('id', $gejalaIds)->pluck('nama_gejala')->toArray();
                @endphp

                @if(count($gejalaNama) > 0)
                    <span class="inline-block bg-blue-600 px-2 py-1 rounded text-sm">{{ count($gejalaIds) }} gejala</span>
                    <br>
                    <span class="text-gray-300 text-sm">
                        {{ implode(', ', array_slice($gejalaNama, 0, 2)) }}
                        @if(count($gejalaNama) > 2)
                            <br>+{{ count($gejalaNama) - 2 }} lainnya
                        @endif
                    </span>
                @else
                    <span class="text-red-400">-</span>
                @endif
            </td>
            <td class="p-3 border text-center">
                <strong class="text-yellow-400">{{ number_format($rule->certainty_factor, 2) }}</strong>
                <br>
                <span class="text-gray-300 text-sm">
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
            <td class="p-3 border text-center">
                <a href="{{ route('rule.show', $rule->id) }}"
                   class="inline-block px-3 py-1 bg-cyan-500
                              text-white rounded-lg shadow
                              hover:bg-cyan-600 transition text-sm">
                    Lihat
                </a>

                <a href="{{ route('rule.edit', $rule->id) }}"
                   class="inline-block px-3 py-1 bg-blue-500
                              text-white rounded-lg shadow
                              hover:bg-blue-600 transition text-sm">
                    Edit
                </a>

                <form action="{{ route('rule.destroy', $rule->id) }}"
                      method="POST"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus rule ini?')"
                             class="px-3 py-1 bg-red-500
                                       text-white rounded-lg shadow
                                       hover:bg-red-600 transition text-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-3 border text-center text-gray-400">
                Tidak ada rule. <a href="{{ route('rule.create') }}" class="text-blue-400 hover:underline">Buat yang pertama?</a>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

@endsection
