@extends('layouts.admin')

@section('content')
    <div class="container max-w-4xl mx-auto mt-8">
        <div class="bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-2xl font-bold mb-6 text-center text-green-700">Tambah Data Warga</h1>
            <p class="mb-6 text-gray-600 text-center">Silakan isi data warga dengan benar pada form berikut.</p>

            <form action="{{ route('admin.warga.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="nik" class="block font-semibold mb-1">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 @error('nik') border-red-500 @enderror"
                        placeholder="Masukkan NIK">
                    @error('nik')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="nama" class="block font-semibold mb-1">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 @error('nama') border-red-500 @enderror"
                        placeholder="Masukkan Nama Lengkap">
                    @error('nama')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="alamat" class="block font-semibold mb-1">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                        placeholder="Masukkan Alamat">
                </div>

                <div>
                    <label for="kelurahan" class="block font-semibold mb-1">Kelurahan</label>
                    <input type="text" name="kelurahan" id="kelurahan" value="{{ old('kelurahan') }}"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                        placeholder="Masukkan Kelurahan">
                </div>

                <div class="flex items-center justify-between mt-6">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 transition text-white px-6 py-2 rounded font-semibold shadow">
                        Simpan
                    </button>
                    <a href="{{ route('admin.warga.index') }}"
                        class="text-gray-600 hover:text-green-700 underline ml-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
