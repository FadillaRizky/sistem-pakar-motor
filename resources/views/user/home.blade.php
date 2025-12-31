@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow text-center">
    <h2 class="text-2xl font-bold mb-4">
        Selamat Datang
    </h2>

    <p class="mb-6">
        Sistem ini membantu mendiagnosa kerusakan ringan sepeda motor
        berdasarkan gejala yang Anda alami.
    </p>

    <a href="{{ route('konsultasi.index') }}"
       class="bg-blue-600 text-white px-6 py-3 rounded">
        Mulai Konsultasi
    </a>
</div>
@endsection
