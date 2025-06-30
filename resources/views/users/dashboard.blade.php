@extends('layouts.users')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Selamat datang di users Dashboard</h2>
    <div class="bg-white rounded-lg shadow mt-4">
        <div class="p-6">
            <p class="text-lg">Halo, <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
            <p class="mt-2">Anda berhasil login sebagai <strong
                    class="text-blue-600">{{ Auth::user()->role ?? 'User' }}</strong>.</p>
            <p class="mt-4 text-gray-600">Silakan gunakan menu di samping untuk mengakses fitur-fitur yang tersedia.</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow mt-4">
        <div class="p-4">
            {{-- Tambahan: Statistik sederhana --}}
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-2">Info Akun</h3>
                <ul class="list-disc list-inside text-gray-700">
                    <li>Email: {{ Auth::user()->email }}</li>
                    <li>Tanggal Bergabung: {{ Auth::user()->created_at->format('d M Y') }}</li>
                </ul>
            </div>
        </div>

    </div>
@endsection
