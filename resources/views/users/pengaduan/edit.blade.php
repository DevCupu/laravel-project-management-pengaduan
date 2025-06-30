@extends('layouts.users')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Pengaduan</h2>

        @if (session('success'))
            <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.pengaduan.edit', $pengaduan->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Pengaduan</label>
                <input type="text" name="judul" id="judul"
                    class="block w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    value="{{ old('judul', $pengaduan->judul) }}" required>
            </div>

            <!-- Isi Pengaduan -->
            <div>
                <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">Isi Pengaduan</label>
                <textarea name="isi" id="isi" rows="5"
                    class="block w-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    required>{{ old('isi', $pengaduan->isi) }}</textarea>
            </div>

            <!-- Kategori -->
            <div>
                <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span
                        class="text-red-500">*</span></label>
                <select name="kategori_id" id="kategori_id"
                    class="w-full border border-gray-300 rounded-lg p-3 bg-white text-black text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="" disabled selected>- Pilih Kategori -</option>
                    @forelse ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->name_kategori ?? 'Tanpa Nama' }}</option>
                    @empty
                        <option value="">Tidak ada kategori</option>
                    @endforelse
                </select>

            </div>

            <!-- Gambar -->
            <div>
                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar (opsional)</label>
                @if ($pengaduan->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $pengaduan->gambar) }}" alt="Gambar Pengaduan"
                            class="w-36 rounded shadow">
                    </div>
                @endif
                <input type="file" name="gambar" id="gambar"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <!-- Tombol Submit -->
            <div class="flex space-x-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update
                    Pengaduan</button>
                <a href="{{ route('users.pengaduan.index') }}"
                    class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">Batal</a>
            </div>
        </form>
    </div>
@endsection
