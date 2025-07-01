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

        <!-- Modern Responsive Layout with Sidebar -->
        <div class="min-h-screen flex bg-gradient-to-br from-blue-50 via-white to-blue-100">
            <!-- Sidebar -->
            <input type="checkbox" id="sidebar-toggle" class="hidden peer" />
            <aside
                class="fixed z-30 inset-y-0 left-0 w-64 bg-white/90 backdrop-blur-lg border-r border-blue-100 shadow-xl flex flex-col transform -translate-x-full transition-transform duration-200 ease-in-out peer-checked:translate-x-0 md:static md:translate-x-0 md:w-72 md:flex md:z-auto">
                <div class="flex items-center gap-3 mb-10 px-4 pt-6">
                    <span
                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                fill="none" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l2 2 4-4" />
                        </svg>
                    </span>
                    <span class="text-2xl font-bold text-blue-700 tracking-wide">SI-Lapor</span>
                </div>
                <nav class="flex-1 px-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('users.dashboard') }}"
                                class="flex items-center gap-4 py-3 px-4 rounded-xl group transition-all font-semibold
                                    {{ request()->routeIs('users.dashboard') ? 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 shadow' : 'text-blue-900 hover:bg-blue-50 hover:text-blue-700' }}">
                                <span class="flex items-center justify-center w-10 h-10 rounded-lg
                                    {{ request()->routeIs('users.dashboard') ? 'bg-blue-200' : 'bg-blue-50 group-hover:bg-blue-100' }}">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6" />
                                    </svg>
                                </span>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.pengaduan.index') }}"
                                class="flex items-center gap-4 py-3 px-4 rounded-xl group transition-all font-semibold
                                    {{ request()->routeIs('users.pengaduan.index') ? 'bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 shadow' : 'text-blue-900 hover:bg-blue-50 hover:text-blue-700' }}">
                                <span class="flex items-center justify-center w-10 h-10 rounded-lg
                                    {{ request()->routeIs('users.pengaduan.index') ? 'bg-blue-200' : 'bg-blue-50 group-hover:bg-blue-100' }}">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1h-6a1 1 0 00-1 1v9" />
                                    </svg>
                                </span>
                                <span>Pengaduan</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="mt-auto px-4 pb-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 py-2 px-4 rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-semibold shadow transition-all">
                            <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Sidebar Toggle Button (Mobile) -->
            <label for="sidebar-toggle"
                class="md:hidden fixed z-40 top-4 left-4 bg-blue-600 text-white p-2 rounded-full shadow-lg cursor-pointer">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>
            <!-- Overlay for Sidebar (Mobile) -->
            <label for="sidebar-toggle"
                class="fixed inset-0 bg-white bg-opacity-40 z-20 hidden peer-checked:block md:hidden"></label>

            <!-- Main Content -->
            <main class="flex-1 p-4 md:p-10 mt-16 md:mt-0 w-full max-w-6xl mx-auto">
                <div class="rounded-2x p-6 md:p-10 min-h-[60vh]">
                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

    </div>
</body>
<!-- Bootstrap 5 JS Bundle CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
