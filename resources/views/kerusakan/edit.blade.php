@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Kerusakan</h1>

<form action="{{ route('kerusakan.update', $kerusakan->id) }}"
      method="POST"
      class="bg-white p-6 rounded shadow w-2/3">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-1">Kode Kerusakan</label>
        <input type="text" name="kode_kerusakan"
               value="{{ $kerusakan->kode_kerusakan }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Nama Kerusakan</label>
        <input type="text" name="nama_kerusakan"
               value="{{ $kerusakan->nama_kerusakan }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Solusi</label>
        <textarea name="solusi"
                  class="w-full border rounded p-2"
                  rows="4">{{ $kerusakan->solusi }}</textarea>
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">
        Update
    </button>
</form>
@endsection
