<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pakar Motor</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-black min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-gray-800 rounded-lg shadow-2xl overflow-hidden border border-gray-700">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 text-center">
                <i class="fas fa-motorcycle text-white mb-3" style="font-size: 2.5rem;"></i>
                <h1 class="text-3xl font-bold text-white mt-2">Sistem Pakar Motor</h1>
                <p class="text-blue-100 text-sm mt-1">Diagnosa Kerusakan Motor</p>
            </div>

            <!-- Form -->
            <div class="p-8">
                <h2 class="text-2xl font-bold text-white mb-6">Login</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-900/30 border border-red-500 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p class="text-red-200 text-sm">
                                <i class="fas fa-exclamation-circle"></i> {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2">Email Address</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="example@email.com"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 text-white rounded-lg
                                      focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30
                                      transition"
                               required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-gray-300 text-sm font-semibold mb-2">Password</label>
                        <input type="password"
                               name="password"
                               placeholder="••••••••"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 text-white rounded-lg
                                      focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30
                                      transition"
                               required>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox"
                               name="remember"
                               id="remember"
                               class="w-4 h-4 cursor-pointer">
                        <label for="remember" class="ml-2 text-gray-300 text-sm cursor-pointer">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full py-3 bg-gradient-to-r from-blue-600 to-blue-700
                                   text-white font-bold rounded-lg shadow-lg
                                   hover:opacity-90 transition mt-6">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-gray-800 text-gray-400">Belum punya akun?</span>
                    </div>
                </div>

                <!-- Register Link -->
                <a href="{{ route('register') }}"
                   class="block w-full text-center py-3 bg-gray-700 hover:bg-gray-600
                          text-white font-semibold rounded-lg transition">
                    <i class="fas fa-user-plus"></i> Buat Akun Baru
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
