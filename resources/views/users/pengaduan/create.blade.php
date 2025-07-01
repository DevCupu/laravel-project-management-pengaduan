@extends('layouts.users')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-3xl p-10 border border-gray-100">
        <h2 class="text-3xl font-extrabold mb-8 text-gray-900 text-center">Buat Pengaduan Baru</h2>
        <form action="{{ route('users.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-7">
            @csrf

            <div>
                <label for="judul" class="block text-base font-semibold text-gray-700 mb-2">Judul <span
                        class="text-red-500">*</span></label>
                <input type="text" name="judul" id="judul"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400"
                    required placeholder="Masukkan judul pengaduan" />
            </div>

            <div>
                <label for="kategori_id" class="block text-base font-semibold text-gray-700 mb-2">Kategori <span
                        class="text-red-500">*</span></label>
                <select name="kategori_id" id="kategori_id"
                    class="w-full border border-gray-300 rounded-xl p-3 bg-white text-gray-900 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    required>
                    <option value="" disabled selected>- Pilih Kategori -</option>
                    @forelse ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->name_kategori ?? 'Tanpa Nama' }}</option>
                    @empty
                        <option value="">Tidak ada kategori</option>
                    @endforelse
                </select>
            </div>

            <div>
                <label for="isi" class="block text-base font-semibold text-gray-700 mb-2">Isi Pengaduan <span
                        class="text-red-500">*</span></label>
                <textarea name="isi" id="isi"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400"
                    rows="6" required placeholder="Tuliskan detail pengaduan Anda"></textarea>
            </div>

            <div>
                <label for="gambar" class="block text-base font-semibold text-gray-700 mb-2">Upload Gambar <span
                        class="text-gray-400 font-normal">(Opsional)</span></label>
                <input type="file" name="gambar" id="gambar"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG. Maksimal 2MB.</p>
            </div>

            <div>
                <label for="lampiran" class="block text-base font-semibold text-gray-700 mb-2">Lampiran Tambahan <span
                        class="text-gray-400 font-normal">(Opsional, bisa lebih dari 1)</span></label>
                <input type="file" name="lampiran[]" id="lampiran" multiple
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                <p class="text-xs text-gray-400 mt-2">Format yang diizinkan: PDF, DOCX, JPG, PNG. Maks 5MB per file.</p>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-base font-bold rounded-xl shadow transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
@endsection
