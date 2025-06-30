<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-800">
        @include('layouts.navigation')
        <!-- Page Content with Sidebar -->
        <div class="flex min-h-screen bg-gray-100">
            <!-- Sidebar -->
            <aside class="w-72 bg-gradient-to-b from-blue-800 to-blue-900 text-white p-6 shadow-xl flex flex-col">
                <div class="flex items-center mb-10">
                    <svg class="w-10 h-10 mr-3 text-blue-300" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                            fill="none" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l2 2 4-4" />
                    </svg>
                    <span class="text-3xl font-extrabold tracking-wide">SI-Lapor</span>
                </div>
                <nav class="flex-1">
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('users.dashboard') }}"
                                class="flex items-center py-3 px-5 rounded-xl hover:bg-blue-700 transition-colors font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }}">
                                <svg class="w-6 h-6 mr-4 text-blue-200" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.pengaduan.index') }}"
                                class="flex items-center py-3 px-5 rounded-xl hover:bg-blue-700 transition-colors font-medium {{ request()->routeIs('admin.pengaduan.*') ? 'bg-blue-700' : '' }}">
                                <svg class="w-6 h-6 mr-4 text-blue-200" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                </svg>
                                Kelola Pengaduan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center py-3 px-5 rounded-xl hover:bg-blue-700 transition-colors font-medium {{ request()->routeIs('admin.users.*') ? 'bg-blue-700' : '' }}">
                                <svg class="w-6 h-6 mr-4 text-blue-200" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 10-8 0 4 4 0 008 0z" />
                                </svg>
                                Kelola Pelapor
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="mt-10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center py-2 px-5 rounded-xl bg-blue-700 hover:bg-blue-800 transition-colors font-medium">
                            <svg class="w-6 h-6 mr-4 text-blue-200" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-8">
                @yield('content')
            </main>
        </div>

    </div>
</body>
<!-- Bootstrap 5 JS Bundle CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
