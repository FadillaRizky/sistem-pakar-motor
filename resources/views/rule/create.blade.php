@extends('layouts.admin')

@section('content')
    {{-- <div class="max-w-3xl bg-white rounded shadow p-6"> --}}

    <h1 class="text-2xl font-bold mb-4 text-white">
        Tambah Rule Diagnosa
    </h1>

    <form method="POST" action="{{ route('rule.store') }}" class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
        @csrf

        <!-- PILIH KERUSAKAN -->
        <div class="mb-5">
           <label class="block mb-2 text-xl font-bold text-gray-700">
                Kerusakan
            </label>

            <select name="kerusakan_id"class="w-full border border-gray-300 rounded-lg p-2.5
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                          focus:border-blue-500 transition" required>

                <option value="">-- Pilih Kerusakan --</option>

                @foreach ($kerusakans as $k)
                    <option value="{{ $k->id }}">
                        {{ $k->nama_kerusakan }}
                    </option>
                @endforeach

            </select>

        </div>


        <!-- PILIH GEJALA -->
        <div class="mb-5">
            <label class="block mb-3 text-xl font-bold text-gray-700">
                Gejala
            </label>

            <div class="grid grid-cols-2 gap-3">
                @foreach ($gejalas as $g)
                    <label class="block mb-2 text-md font-semibold text-gray-700">
                        <input type="checkbox" name="gejala_ids[]" value="{{ $g->id }}"
                            class="text-blue-600 focus:ring-blue-500">
                        <span class="text-gray-800">
                            {{ $g->nama_gejala }}

                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- BUTTON -->
        <div class="flex justify-start  ">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                Simpan Rule
            </button>
        </div>

    </form>

    {{-- </div> --}}
@endsection
