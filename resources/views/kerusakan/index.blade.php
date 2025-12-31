@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-white">Data Kerusakan</h1>

<a href="{{ route('kerusakan.create') }}"
    class="mb-4 inline-block px-5 py-2 bg-gradient-to-r from-green-500 to-green-600
              text-white font-semibold rounded-lg shadow hover:opacity-90 transition">
    + Tambah Kerusakan
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
            <th class="p-3 text-center border border-blue-700">Kode</th>
            <th class="p-3 text-center border border-blue-700">Nama Kerusakan</th>
            <th class="p-3 text-center border border-blue-700">Solusi</th>
            <th class="p-3 text-center border border-blue-700">Aksi</th>
        </tr>
    </thead>
    <tbody class=" text-white">
        @foreach ($kerusakans as $item)
        <tr>
            <td class="p-3 border text-center">{{ $loop->iteration }}</td>
            <td class="p-3 border">{{ $item->kode_kerusakan }}</td>
            <td class="p-3 border">{{ $item->nama_kerusakan }}</td>
            <td class="p-3 border">{{ $item->solusi }}</td>
            <td class="p-3 border text-center">
                <a href="{{ route('kerusakan.edit', $item->id) }}"
                   class="inline-block px-3 py-1 bg-blue-500
                              text-white rounded-lg shadow
                              hover:bg-blue-600 transition">
                    Edit
                </a>

                <form action="{{ route('kerusakan.destroy', $item->id) }}"
                      method="POST"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus data ini?')"
                             class="px-3 py-1 bg-red-500
                                       text-white rounded-lg shadow
                                       hover:bg-red-600 transition">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection
