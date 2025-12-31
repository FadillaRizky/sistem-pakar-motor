@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4 text-white">Tambah Kerusakan</h1>

<form action="{{ route('kerusakan.store') }}" method="POST"
     class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
    @csrf

    <div class="mb-5">
        <label class="block mb-2 text-xl font-bold text-gray-700">Kode Kerusakan</label>
        <input type="text" name="kode_kerusakan"
                class="w-full border border-gray-300 rounded-lg p-2.5
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                          focus:border-blue-500 transition" required>
    </div>

    <div class="mb-5">
        <label class="block mb-2 text-xl font-bold text-gray-700">Nama Kerusakan</label>
        <input type="text" name="nama_kerusakan"
               class="w-full border border-gray-300 rounded-lg p-2.5
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                          focus:border-blue-500 transition" required>
    </div>

    <div class="mb-5">
        <label class="block mb-2 text-xl font-bold text-gray-700">Solusi</label>
        <textarea name="solusi"
                  class="w-full border rounded p-2"
                  rows="4" required></textarea>
    </div>

     <div class="flex gap-3">
            <button type="submit"
                    class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600
                           text-white font-semibold rounded-lg shadow
                           hover:opacity-90 transition">
                💾 Simpan
            </button>

            <a href="{{ route('kerusakan.index') }}"
               class="px-5 py-2.5 bg-gray-200 text-gray-700
                      rounded-lg hover:bg-gray-300 transition">
                ⬅ Kembali
            </a>
        </div>
</form>
@endsection
