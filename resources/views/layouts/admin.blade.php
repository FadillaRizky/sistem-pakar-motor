<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-900">


<div class="flex min-h-screen">

    <!-- SIDEBAR -->
  <aside class="w-64 bg-gray-900 !text-white">


        <div class="p-4 text-xl font-bold border-b border-gray-700">
            Sistem Pakar Motor
        </div>

        <nav class="mt-4">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">
                Dashboard
            </a>

            <a href="{{ route('gejala.index') }}" class="block px-4 py-2 hover:bg-gray-700">
                Data Gejala
            </a>

            <a href="{{ route('kerusakan.index') }}" class="block px-4 py-2 hover:bg-gray-700">
                Data Kerusakan
            </a>

            <a href="{{ route('rule.index') }}" class="block px-4 py-2 hover:bg-gray-700">
                Rule
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 hover:bg-red-600">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</div>

</body>
</html>
