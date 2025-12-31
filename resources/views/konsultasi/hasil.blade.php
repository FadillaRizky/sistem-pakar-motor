@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">

<h2 class="text-xl font-bold mb-4">
    Hasil Diagnosa
</h2>

@if($hasil)
    <div class="bg-green-100 p-4 rounded">
        <p><strong>Kerusakan:</strong>
            {{ $hasil->nama_kerusakan }}
        </p>

        <p><strong>Solusi:</strong>
            {{ $hasil->solusi }}
        </p>

        <p><strong>Tingkat Kecocokan:</strong>
            {{ number_format($persentase, 2) }} %
        </p>
    </div>
@else
    <div class="bg-red-100 p-4 rounded">
        Kerusakan tidak dapat ditentukan.
    </div>
@endif

<a href="{{ route('konsultasi.index') }}"
   class="inline-block mt-4 text-blue-600">
   Konsultasi Ulang
</a>

</div>
@endsection
