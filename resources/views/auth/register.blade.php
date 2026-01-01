<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Pakar Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black min-h-screen flex items-center justify-center py-8">

    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-gray-800 rounded-lg shadow-2xl overflow-hidden border border-gray-700">

            <!-- Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 p-6 text-center">
                <i class="fas fa-user-shield text-white mb-3" style="font-size: 2.5rem;"></i>
                <h1 class="text-3xl font-bold text-white mt-2">Daftar Akun</h1>
                <p class="text-green-100 text-sm mt-1">Buat akun untuk menggunakan sistem</p>
            </div>

            <!-- Form -->
            <div class="p-8">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-900/30 border border-red-500 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-200 text-sm">
                                <i class="fas fa-exclamation-circle"></i> {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2">Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="John Doe"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 text-white rounded-lg
                                      focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30
                                      transition"
                               required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2">Email Address</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="example@email.com"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 text-white rounded-lg
                                      focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30
                                      transition"
                               required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2">Password</label>
                        <input type="password"
                               name="password"
                               placeholder="Minimal 6 karakter"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 text-white rounded-lg
                                      focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30
                                      transition"
                               required>
                        <p class="text-gray-400 text-xs mt-1">Password minimal 6 karakter</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2">Konfirmasi Password</label>
                        <input type="password"
                               name="password_confirmation"
                               placeholder="Ulangi password"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 text-white rounded-lg
                                      focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30
                                      transition"
                               required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full py-3 bg-gradient-to-r from-green-600 to-green-700
                                   text-white font-bold rounded-lg shadow-lg
                                   hover:opacity-90 transition mt-6">
                        <i class="fas fa-check-circle"></i> Daftar Sekarang
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-gray-800 text-gray-400">Sudah punya akun?</span>
                    </div>
                </div>

                <!-- Login Link -->
                <a href="{{ route('login') }}"
                   class="block w-full text-center py-3 bg-gray-700 hover:bg-gray-600
                          text-white font-semibold rounded-lg transition">
                    <i class="fas fa-sign-in-alt"></i> Login Sekarang
                </a>
            </div>

            <!-- Footer -->
            <div class="bg-gray-900 px-8 py-4 text-center text-gray-400 text-xs">
                <p>© 2026 Sistem Pakar Motor. All rights reserved.</p>
            </div>
        </div>
    </div>

</body>
</html>
