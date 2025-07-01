@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Edit Kategori Pengaduan</h1>

            <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input
                        type="text"
                        name="nama_kategori"
                        class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 p-3 rounded-lg transition duration-200 outline-none"
                        value="{{ old('nama_kategori', $kategori->name_kategori) }}"
                        required
                        autocomplete="off"
                    >
                    @error('nama_kategori')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition text-white px-6 py-2 rounded-lg font-semibold shadow">
                        Update
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="text-gray-500 hover:text-blue-600 transition font-medium">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
