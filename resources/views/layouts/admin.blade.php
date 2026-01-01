<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ config('app.name', 'Sistem Pakar Motor') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 antialiased text-slate-100">

<div class="min-h-screen flex bg-slate-950 text-slate-100">
    {{-- SIDEBAR ADMIN: lengkap --}}
    <aside class="w-56 bg-slate-900 border-r border-slate-800 hidden md:flex flex-col">
        <div class="px-4 py-4 font-semibold text-sm border-b border-slate-800">
            Panel Admin
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-3 py-2 rounded-lg
                      {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/70' }}">
                Dashboard
            </a>

            <a href="{{ route('gejala.index') }}"
               class="flex items-center px-3 py-2 rounded-lg
                      {{ request()->routeIs('gejala.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/70' }}">
                Data Gejala
            </a>

            <a href="{{ route('kerusakan.index') }}"
               class="flex items-center px-3 py-2 rounded-lg
                      {{ request()->routeIs('kerusakan.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/70' }}">
                Data Kerusakan
            </a>

            <a href="{{ route('rule.index') }}"
               class="flex items-center px-3 py-2 rounded-lg
                      {{ request()->routeIs('rule.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800/70' }}">
                Rule
            </a>
        </nav>

        <div class="px-3 py-4 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center px-3 py-2 text-sm rounded-lg
                               text-red-200 border border-red-500/60 hover:bg-red-500/10 transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- KONTEN ADMIN --}}
    <main class="flex-1">
        @yield('content')
    </main>
</div>

</body>
</html>
