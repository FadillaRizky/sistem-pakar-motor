@extends('layouts.admin')

@section('content')
{{-- <div class="max-w-xl"> --}}

    <h1 class="text-2xl font-bold mb-6 text-white">
        Tambah Gejala
    </h1>

    <form action="{{ route('gejala.store') }}" method="POST"
          class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
        @csrf

        <div class="mb-5">
            <label class="block mb-2 text-xl font-bold text-gray-700">
                Kode Gejala
            </label>
            <input type="text" name="kode_gejala" required
                   placeholder="Contoh: G01"
                   class="w-full border border-gray-300 rounded-lg p-2.5
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                          focus:border-blue-500 transition">
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-xl font-bold text-gray-700">
                Nama Gejala
            </label>
            <input type="text" name="nama_gejala" required
                   placeholder="Masukkan nama gejala"
                   class="w-full border border-gray-300 rounded-lg p-2.5
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                          focus:border-blue-500 transition">
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600
                           text-white font-semibold rounded-lg shadow
                           hover:opacity-90 transition">
                💾 Simpan
            </button>

            <a href="{{ route('gejala.index') }}"
               class="px-5 py-2.5 bg-gray-200 text-gray-700
                      rounded-lg hover:bg-gray-300 transition">
                ⬅ Kembali
            </a>
        </div>
    </form>

{{-- </div> --}}
@endsection
