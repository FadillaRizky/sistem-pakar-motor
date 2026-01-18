<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Admin - Sistem Pakar Motor')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #1f2937;
        }
        ::-webkit-scrollbar-thumb {
            background: #4b5563;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #6b7280;
        }

        /* Sidebar transition */
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            background: rgba(59, 130, 246, 0.1);
            border-left: 3px solid #3b82f6;
        }
        .sidebar-link.active {
            background: rgba(59, 130, 246, 0.2);
            border-left: 3px solid #3b82f6;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 border-r border-gray-700 fixed h-full overflow-y-auto">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-700">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-motorcycle text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-lg">Sistem Pakar</h1>
                        <p class="text-gray-400 text-xs">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <p class="text-white font-medium text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-gray-400 text-xs">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                   class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-300 rounded-r-lg {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Gejala -->
                <a href="{{ route('gejala.index') }}"
                   class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-300 rounded-r-lg {{ request()->routeIs('gejala.*') ? 'active' : '' }}">
                    <i class="fas fa-list-ul w-5 text-blue-400"></i>
                    <span class="font-medium">Gejala</span>
                </a>

                <!-- Kerusakan -->
                <a href="{{ route('kerusakan.index') }}"
                   class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-300 rounded-r-lg {{ request()->routeIs('kerusakan.*') ? 'active' : '' }}">
                    <i class="fas fa-exclamation-triangle w-5 text-green-400"></i>
                    <span class="font-medium">Kerusakan</span>
                </a>

                <!-- Rule -->
                <a href="{{ route('rule.index') }}"
                   class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-300 rounded-r-lg {{ request()->routeIs('rule.*') ? 'active' : '' }}">
                    <i class="fas fa-project-diagram w-5 text-purple-400"></i>
                    <span class="font-medium">Rule</span>
                </a>

                <!-- Motor -->
                <a href="{{ route('motor.index') }}"
                   class="sidebar-link flex items-center space-x-3 px-4 py-3 text-gray-300 rounded-r-lg {{ request()->routeIs('motor.*') ? 'active' : '' }}">
                    <i class="fas fa-motorcycle w-5 text-orange-400"></i>
                    <span class="font-medium">Jenis Motor</span>
                </a>

                <div class="border-t border-gray-700 my-4"></div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                            class="sidebar-link w-full flex items-center space-x-3 px-4 py-3 text-red-400 hover:text-red-300 rounded-r-lg">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
