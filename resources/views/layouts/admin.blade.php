<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'si-lapor') }}</title>

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
                <nav class="flex-1">
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('users.dashboard') }}"
                                class="group flex items-center py-3 px-5 rounded-xl transition-colors font-medium relative
                                    {{ request()->routeIs('admin.dashboard') ? 'bg-blue-300' : '' }}"
                                style="width: calc(90% - 10px); margin-left: 20px">
                                <span
                                    class="absolute inset-0 rounded-xl group-hover:bg-blue-100 transition-colors -z-10"></span>
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
                                class="group flex items-center py-3 px-5 rounded-xl transition-colors font-medium relative
                                    {{ request()->routeIs('admin.pengaduan.*') ? 'bg-blue-300' : '' }}"
                                style="width: calc(90% - 10px); margin-left: 20px">
                                <span
                                    class="absolute inset-0 rounded-xl group-hover:bg-blue-100 transition-colors -z-10"></span>
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
                                class="group flex items-center py-3 px-5 rounded-xl transition-colors font-medium relative
                                    {{ request()->routeIs('admin.users.*') ? 'bg-blue-300' : '' }}"
                                style="width: calc(90% - 10px); margin-left: 20px">
                                <span
                                    class="absolute inset-0 rounded-xl group-hover:bg-blue-100 transition-colors -z-10"></span>
                                <svg class="w-6 h-6 mr-4 text-blue-200" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 10-8 0 4 4 0 008 0z" />
                                </svg>
                                Kelola Pelapor
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.kategori.index') }}"
                                class="group flex items-center py-3 px-5 rounded-xl transition-colors font-medium relative
                                    {{ request()->routeIs('admin.categories.*') ? 'bg-blue-300' : '' }}"
                                style="width: calc(90% - 10px); margin-left: 20px">
                                <span
                                    class="absolute inset-0 rounded-xl group-hover:bg-blue-100 transition-colors -z-10"></span>
                                <svg class="w-6 h-6 mr-4 text-blue-200" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                Kelola Kategori
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.warga.index') }}"
                                class="group flex items-center py-3 px-5 rounded-xl transition-colors font-medium relative
                                    {{ request()->routeIs('admin.warga.*') ? 'bg-blue-300' : '' }}"
                                style="width: calc(90% - 10px); margin-left: 20px">
                                <span
                                    class="absolute inset-0 rounded-xl group-hover:bg-blue-100 transition-colors -z-10"></span>
                                <svg class="w-6 h-6 mr-4 text-blue-200" fill="none" stroke="currentColor"
                                    stroke-width="2" vi ewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 11c1.657 0 3 1.343 3 3v4H5v-4c0-1.657 1.343-3 3-3h8zm-4-4a4 4 0 110 8 4 4 0 010-8z" />
                                </svg>
                                Warga Terdaftar
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
            <main class="flex-1 p-5 md:p-8 mt-14 md:mt-0 w-full max-w-6xl mx-auto transition-all duration-300">
                <header class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h1 class="text-4xl font-black text-blue-800 tracking-tight leading-tight drop-shadow-sm">
                        @yield('title', 'Dashboard')</h1>
                    @hasSection('actions')
                        <div class="flex gap-2">
                            @yield('actions')
                        </div>
                    @endif
                </header>
                <div class="space-y-8">
                    @yield('content')
                </div>
        </div>
        </main>
    </div>

    </div>
</body>
<!-- Bootstrap 5 JS Bundle CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
