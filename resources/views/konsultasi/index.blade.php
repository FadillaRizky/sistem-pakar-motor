@extends('layouts.app') {{-- DULUNYA layouts.admin --}}

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-white mb-2">Konsultasi Diagnosa Motor</h1>
    <p class="text-gray-400">Pilih gejala yang Anda alami untuk mendapatkan diagnosis kerusakan motor</p>
</div>

<!-- Info Card -->
<div class="bg-blue-900 border border-blue-700 rounded-lg p-4 mb-6">
    <p class="text-blue-100 text-sm">
        <i class="fas fa-info-circle"></i> <strong>Cara Menggunakan:</strong>
        Centang gejala-gejala yang Anda alami pada motor, lalu klik tombol "Diagnosa" untuk mendapatkan hasil analisis.
    </p>
</div>

<div class="max-w-4xl">
    <form action="{{ route('konsultasi.proses') }}" method="POST" class="bg-gray-900 p-6 rounded-lg border border-gray-700 shadow-lg">
        @csrf

        <!-- Gejala List -->
        <div class="mb-6">
            <label class="block text-white font-bold text-lg mb-4">
                <i class="fas fa-list-check"></i> Pilih Gejala
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($gejalas as $gejala)
                    <div class="bg-gray-800 p-4 rounded-lg border border-gray-700 hover:border-blue-500 transition cursor-pointer"
                         onclick="toggleCheckbox(this)">
                        <label class="flex items-start cursor-pointer">
                            <input type="checkbox"
                                   name="gejala_ids[]"
                                   value="{{ $gejala->id }}"
                                   class="gejala-checkbox mt-1 w-5 h-5 cursor-pointer"
                                   onchange="updateCounter()">
                            <span class="ml-3 flex-1">
                                <strong class="text-blue-400 block">{{ $gejala->kode_gejala }}</strong>
                                <span class="text-white block font-semibold mt-1">{{ $gejala->nama_gejala }}</span>
                                <span class="text-gray-400 text-sm block mt-2">{{ $gejala->deskripsi }}</span>
                            </span>
                        </label>
                    </div>
                @empty
                    <div class="col-span-2 p-6 bg-yellow-900 border border-yellow-700 rounded-lg text-yellow-200 text-center">
                        <i class="fas fa-inbox" style="font-size: 2rem;"></i>
                        <p class="mt-2">Tidak ada gejala tersedia</p>
                    </div>
                @endforelse
            </div>

            <!-- Counter -->
            <div class="mt-4 p-3 bg-blue-900 border border-blue-700 rounded-lg text-blue-200">
                <strong>Gejala Dipilih:</strong> <span id="gejala-count">0</span> gejala
            </div>

            @error('gejala_ids')
                <div class="mt-3 p-3 bg-red-900 border border-red-700 rounded-lg text-red-200">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex gap-3">
            <button type="submit"
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-green-500 to-green-600
                           text-white font-bold rounded-lg shadow-lg
                           hover:opacity-90 transition disabled:opacity-50 disabled:cursor-not-allowed"
                    id="submit-btn"
                    disabled>
                <i class="fas fa-stethoscope"></i> Diagnosa Sekarang
            </button>

            <a href="{{ route('dashboard') }}"
               class="px-6 py-3 bg-gray-700 text-white font-semibold rounded-lg shadow-lg
                      hover:bg-gray-600 transition text-center">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>

    <!-- Tips Section -->
    <div class="mt-6 bg-gray-900 p-6 rounded-lg border border-gray-700">
        <h3 class="text-lg font-bold text-yellow-400 mb-3">
            <i class="fas fa-lightbulb"></i> Tips Diagnosis
        </h3>
        <ul class="text-gray-300 space-y-2 text-sm">
            <li>✓ Pilih gejala yang paling jelas Anda rasakan</li>
            <li>✓ Semakin banyak gejala yang dipilih, semakin akurat hasilnya</li>
            <li>✓ Hasil diagnosis adalah rekomendasi, konsultasikan dengan mekanik profesional</li>
            <li>✓ Anda bisa melakukan diagnosis berkali-kali dengan gejala berbeda</li>
        </ul>
    </div>
</div>

<script>
    function toggleCheckbox(card) {
        const checkbox = card.querySelector('.gejala-checkbox');
        checkbox.checked = !checkbox.checked;
        updateCounter();
    }

    function updateCounter() {
        const count = document.querySelectorAll('.gejala-checkbox:checked').length;
        document.getElementById('gejala-count').textContent = count;
        document.getElementById('submit-btn').disabled = count === 0;
    }

    document.querySelectorAll('.gejala-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateCounter);
    });

    updateCounter();
</script>
@endsection
