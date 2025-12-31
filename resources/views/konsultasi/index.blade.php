@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">

<h2 class="text-xl font-bold mb-4">
    Pilih Gejala yang Dialami
</h2>

<form method="POST" action="{{ route('konsultasi.proses') }}">
@csrf

<div class="grid grid-cols-2 gap-3">
    @foreach($gejalas as $g)
        <label class="flex items-center space-x-2 bg-gray-100 p-2 rounded">
            <input type="checkbox"
                   name="gejala_ids[]"
                   value="{{ $g->id }}">
            <span>{{ $g->nama_gejala }}</span>
        </label>
    @endforeach
</div>

<button class="mt-6 bg-blue-600 text-white px-6 py-2 rounded">
    Proses Diagnosa
</button>

</form>
</div>
@endsection
