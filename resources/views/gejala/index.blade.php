@extends('layouts.admin')

@section('content')
    {{-- <div class="bg-white p-6 rounded-xl shadow-md"> --}}

    <h1 class="text-2xl font-bold mb-6 text-white">
        Data Gejala
    </h1>

    <a href="{{ route('gejala.create') }}"
        class="mb-4 inline-block px-5 py-2 bg-gradient-to-r from-green-500 to-green-600
              text-white font-semibold rounded-lg shadow hover:opacity-90 transition">
        + Tambah Gejala
    </a>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300
                    text-green-800 rounded-lg">
            ✔ {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-lg overflow-hidden">
            <thead class="bg-blue-800 text-white">
                <tr>
                    <th class="p-3 text-center border border-blue-700">No</th>
                    <th class="p-3 text-left border border-blue-700">Kode Gejala</th>
                    <th class="p-3 text-left border border-blue-700">Nama Gejala</th>
                    <th class="p-3 text-center border border-blue-700">Aksi</th>
                </tr>
            </thead>
            <tbody class=" text-white">
                @foreach ($gejalas as $item)
                    <tr>
                        <td class="p-3 border text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="p-3 border font-medium ">
                            {{ $item->kode_gejala }}
                        </td>
                        <td class="p-3 border ">
                            {{ $item->nama_gejala }}
                        </td>
                        <td class="p-3 border text-center space-x-2">
                            <a href="{{ route('gejala.edit', $item->id) }}"
                                class="inline-block px-3 py-1 bg-blue-500
                              text-white rounded-lg shadow
                              hover:bg-blue-600 transition">
                                ✏ Edit
                            </a>

                            <form action="{{ route('gejala.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus data ini?')"
                                    class="px-3 py-1 bg-red-500
                                       text-white rounded-lg shadow
                                       hover:bg-red-600 transition">
                                    🗑 Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- </div> --}}
@endsection
