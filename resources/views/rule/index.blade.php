@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-white">Data Rule</h1>

    <a href="{{ route('rule.create') }}"
        class="mb-4 inline-block px-5 py-2 bg-gradient-to-r from-green-500 to-green-600
              text-white font-semibold rounded-lg shadow hover:opacity-90 transition">
        Tambah Rule
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
                    <th class="p-3 text-center border border-blue-700"></th>>No</th>
                    <th class="p-3 text-center border border-blue-700"></th>>Kerusakan</th>
                    <th class="p-3 text-center border border-blue-700"></th>>Gejala</th>
                    <th class="p-3 text-center border border-blue-700"></th>>Aksi</th>
                </tr>
            </thead>
            <tbody class=" text-white">
                @foreach ($rules as $rule)
                    <tr>
                        <td class="p-3 border text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-3 border font-medium ">{{ $rule->kerusakan->nama_kerusakan }}</td>


                        <td class="p-3 border font-medium">
    {{ collect($rule->gejala_ids)
        ->map(fn($gid) => $gejalas[$gid]->nama_gejala ?? '-')
        ->implode(', ') }}
</td>


                        <td class="p-3 border ">
                            <a href="{{ route('rule.edit', $rule->id) }}"
                                class="inline-block px-3 py-1 bg-blue-500
                              text-white rounded-lg shadow
                              hover:bg-blue-600 transition">Edit</a>

                            <form action="{{ route('rule.destroy', $rule->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
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
@endsection
