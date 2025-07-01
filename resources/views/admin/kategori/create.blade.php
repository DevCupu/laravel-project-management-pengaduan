@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-8 flex justify-center">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Tambah Kategori Pengaduan</h1>

            <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                    <input type="text" name="name_kategori" class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-3 rounded-lg transition duration-200" required>
                    @error('name_kategori')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition text-white font-semibold px-6 py-2 rounded-lg shadow">
                        Simpan
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="text-gray-500 hover:text-blue-600 transition font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
