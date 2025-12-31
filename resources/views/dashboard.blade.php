@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-white">Dashboard Admin</h1>

    <div class="grid grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded shadow mb-2">
            <h2 class="text-gray-500">Gejala</h2>
            <p class="text-2xl font-bold text-gray-500">{{ $gejala }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow mb-2">
            <h2 class="text-gray-500">Kerusakan</h2>
            <p class="text-2xl font-bold text-gray-500">{{ $kerusakan }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow mb-2">
            <h2 class="text-gray-500">Rule</h2>
            <p class="text-2xl font-bold text-gray-500">{{ $rule }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow mb-2">
            <h2 class="text-gray-500">User</h2>
            <p class="text-2xl font-bold text-gray-500">{{ $user }}</p>
        </div>
    </div>
@endsection
