<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Konsultasi Diagnosa Motor - {{ config('app.name', 'Sistem Pakar Motor') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        <!-- Tailwind CSS (via CDN untuk development tanpa build) -->
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body {
                background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900">
        <!-- Header / Navigation -->
        <nav class="bg-gray-900 border-b border-gray-700 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-motorcycle text-white text-xl"></i>
                            </div>
                            <div>
                                <h1 class="text-white font-bold text-lg">Sistem Pakar Motor</h1>
                                <p class="text-gray-400 text-xs">Diagnosa Kerusakan Motor</p>
                            </div>
                        </a>
                    </div>

                    <!-- Right Menu -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">
                                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-300 hover:text-red-400 px-3 py-2 rounded-md text-sm font-medium transition">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg">
                                <i class="fas fa-sign-in-alt mr-1"></i> Login Admin
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="min-h-screen py-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-white mb-3">
                        <i class="fas fa-stethoscope text-blue-400"></i>
                        Konsultasi Diagnosa Motor
                    </h1>
                    <p class="text-gray-400 text-lg">
                        Pilih gejala yang Anda alami untuk mendapatkan diagnosis kerusakan motor
                    </p>
                </div>

                <!-- Info Card -->
                <div class="bg-blue-900 border border-blue-700 rounded-lg p-5 mb-8 shadow-lg">
                    <p class="text-blue-100">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong class="text-white">Cara Menggunakan:</strong>
                        Centang gejala-gejala yang Anda alami pada motor, lalu klik tombol "Diagnosa" untuk mendapatkan hasil analisis.
                    </p>
                </div>

                <!-- Consultation Form -->
                <div class="max-w-4xl mx-auto">
                    <form action="{{ route('konsultasi.public.proses') }}" method="POST" class="bg-gray-900 p-6 rounded-lg border border-gray-700 shadow-xl">
                        @csrf

                        <!-- Pilih Transmisi -->
                        <div class="mb-6">
                            <label class="block text-white font-bold text-lg mb-4">
                                <i class="fas fa-cogs mr-2"></i> Pilih Jenis Transmisi
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <button type="button" onclick="pilihTransmisi('matic')"
                                        class="transmisi-btn p-6 bg-blue-900 border-2 border-blue-700 rounded-lg hover:bg-blue-800 transition text-center"
                                        data-transmisi="matic">
                                    <i class="fas fa-cog text-blue-400 text-2xl mb-2 block"></i>
                                    <span class="text-white font-bold text-lg">MATIC</span>
                                    <span class="text-blue-200 text-sm block mt-1">Otomatis</span>
                                </button>
                                <button type="button" onclick="pilihTransmisi('manual')"
                                        class="transmisi-btn p-6 bg-purple-900 border-2 border-purple-700 rounded-lg hover:bg-purple-800 transition text-center"
                                        data-transmisi="manual">
                                    <i class="fas fa-cogs text-purple-400 text-2xl mb-2 block"></i>
                                    <span class="text-white font-bold text-lg">MANUAL</span>
                                    <span class="text-purple-200 text-sm block mt-1">Kopling</span>
                                </button>
                            </div>
                            <input type="hidden" name="transmisi" id="transmisi_input" value="">
                        </div>

                        <!-- Pilih Jenis Motor -->
                        <div class="mb-6" id="motor_selection" style="display: none;">
                            <label class="block text-white font-bold text-lg mb-4">
                                <i class="fas fa-motorcycle mr-2"></i> Pilih Jenis Motor
                            </label>
                            <select name="motor_id" id="motor_id"
                                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white
                                           focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition">
                                <option value="">-- Pilih Jenis Motor --</option>
                            </select>
                            <p class="text-gray-400 text-sm mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pilih jenis motor untuk hasil diagnosa yang lebih spesifik
                            </p>
                        </div>

                        <!-- Gejala List -->
                        <div class="mb-6">
                            <label class="block text-white font-bold text-lg mb-4">
                                <i class="fas fa-list-check mr-2"></i> Pilih Gejala
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
                                        <i class="fas fa-inbox text-3xl mb-2"></i>
                                        <p>Belum ada data gejala. Silakan hubungi admin.</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Counter -->
                            <div class="mt-4 p-3 bg-blue-900 border border-blue-700 rounded-lg text-blue-200">
                                <strong>Gejala Dipilih:</strong> <span id="gejala-count">0</span> gejala
                            </div>

                            @error('gejala_ids')
                                <div class="mt-3 p-3 bg-red-900 border border-red-700 rounded-lg text-red-200">
                                    <i class="fas fa-exclamation-circle mr-2"></i> {{ $message }}
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
                                <i class="fas fa-stethoscope mr-2"></i> Diagnosa Sekarang
                            </button>

                            <a href="{{ route('home') }}"
                               class="px-6 py-3 bg-gray-700 text-white font-semibold rounded-lg shadow-lg
                                      hover:bg-gray-600 transition text-center">
                                <i class="fas fa-redo mr-2"></i> Reset
                            </a>
                        </div>
                    </form>

                    <!-- Tips Section -->
                    <div class="mt-6 bg-gray-900 p-6 rounded-lg border border-gray-700">
                        <h3 class="text-lg font-bold text-yellow-400 mb-3">
                            <i class="fas fa-lightbulb mr-2"></i> Tips Diagnosis
                        </h3>
                        <ul class="text-gray-300 space-y-2 text-sm">
                            <li>✓ Pilih gejala yang paling jelas Anda rasakan.</li>
                            <li>✓ Semakin banyak gejala yang dipilih, semakin akurat hasilnya.</li>
                            <li>✓ Hasil diagnosis adalah rekomendasi, konsultasikan dengan mekanik profesional.</li>
                            <li>✓ Anda bisa melakukan diagnosis berkali-kali dengan gejala berbeda.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 border-t border-gray-800 py-6 mt-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center text-gray-400 text-sm">
                    <p>&copy; {{ date('Y') }} Sistem Pakar Motor. All rights reserved.</p>
                    <p class="mt-1">Sistem Pakar Diagnosa Kerusakan Motor</p>
                </div>
            </div>
        </footer>

        <script>
            // Data motor dari PHP
            const motorsData = @js($motors);
            let selectedTransmisi = '';

            function pilihTransmisi(transmisi) {
                selectedTransmisi = transmisi;

                // Update visual selection
                document.querySelectorAll('.transmisi-btn').forEach(btn => {
                    btn.classList.remove('ring-4', 'ring-blue-500', 'ring-purple-500', 'bg-blue-800', 'bg-purple-800');
                    if (btn.dataset.transmisi === transmisi) {
                        const ringColor = transmisi === 'matic' ? 'ring-blue-500' : 'ring-purple-500';
                        const bgColor = transmisi === 'matic' ? 'bg-blue-800' : 'bg-purple-800';
                        btn.classList.add('ring-4', ringColor, bgColor);
                    }
                });

                // Update input
                document.getElementById('transmisi_input').value = transmisi;

                // Filter dan tampilkan motor
                filterMotor();

                // Tampilkan pilihan motor
                document.getElementById('motor_selection').style.display = 'block';
            }

            function filterMotor() {
                const motorSelect = document.getElementById('motor_id');
                motorSelect.innerHTML = '<option value="">-- Pilih Jenis Motor --</option>';

                const filteredMotors = motorsData.filter(motor => motor.transmisi === selectedTransmisi);

                filteredMotors.forEach(motor => {
                    const option = document.createElement('option');
                    option.value = motor.id;
                    option.textContent = `${motor.nama_motor} - ${motor.merk}`;
                    motorSelect.appendChild(option);
                });

                // Jika hanya ada 1 motor, pilih otomatis
                if (filteredMotors.length === 1) {
                    motorSelect.value = filteredMotors[0].id;
                }
            }

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
    </body>
</html>
