@extends('layouts.admin')

@section('content')
    <div class="container mx-auto max-w-xl px-4 py-12">
        <div class="bg-white shadow-xl rounded-2xl p-8 md:p-10">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center gap-3">
                <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Edit Data Warga
            </h1>
            <form action="{{ route('admin.warga.update', $warga->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik', $warga->nik) }}"
                        class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-400 transition duration-150 outline-none shadow-sm"
                        placeholder="Masukkan NIK" required>
                    @error('nik')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $warga->nama) }}"
                        class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-400 transition duration-150 outline-none shadow-sm"
                        placeholder="Masukkan Nama" required>
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $warga->alamat) }}"
                        class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-400 transition duration-150 outline-none shadow-sm"
                        placeholder="Masukkan Alamat">
                </div>

                <div>
                    <label for="kelurahan" class="block text-sm font-medium text-gray-700 mb-2">Kelurahan</label>
                    <input type="text" name="kelurahan" id="kelurahan" value="{{ old('kelurahan', $warga->kelurahan) }}"
                        class="w-full border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 rounded-lg px-4 py-2 text-gray-900 placeholder-gray-400 transition duration-150 outline-none shadow-sm"
                        placeholder="Masukkan Kelurahan">
                </div>
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-6">
                    <button type="submit"
                        class="w-full md:w-auto bg-green-500 hover:bg-green-600 transition text-white font-semibold px-8 py-2.5 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.warga.index') }}"
                        class="w-full md:w-auto bg-red-100 hover:bg-red-200 text-red-500 hover:text-red-700 transition text-center font-semibold px-8 py-2.5 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-opacity-50">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
