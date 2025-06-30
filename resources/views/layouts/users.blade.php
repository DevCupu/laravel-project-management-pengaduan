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
                                class="flex items-center py-3 px-5 rounded-xl hover:bg-blue-700 transition-colors font-medium {{ request()->routeIs('users.dashboard') ? 'bg-blue-700' : '' }}">
                                <svg class="w-6 h-6 mr-4 text-blue-200" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.pengaduan.index') }}"
                                class="flex items-center py-3 px-5 rounded-xl hover:bg-blue-700 transition-colors font-medium {{ request()->routeIs('users.pengaduan.index') ? 'bg-blue-700' : '' }}">
                                <svg class="w-6 h-6 mr-4 text-blue-200" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1h-6a1 1 0 00-1 1v9" />
                                </svg>
                                Pengaduan
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
