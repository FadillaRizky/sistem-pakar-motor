@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Gejala</h1>

<form action="{{ route('gejala.update', $gejala->id) }}"
      method="POST"
      class="bg-white p-6 rounded shadow w-1/2">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-1">Kode Gejala</label>
        <input type="text" name="kode_gejala"
               value="{{ $gejala->kode_gejala }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Nama Gejala</label>
        <input type="text" name="nama_gejala"
               value="{{ $gejala->nama_gejala }}"
               class="w-full border rounded p-2">
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">
        Update
    </button>
</form>
@endsection
