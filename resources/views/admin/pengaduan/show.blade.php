@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Detail Pengaduan</h2>

        <div class="mb-6 p-6 bg-gray-50 rounded-lg shadow-inner">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="mb-3">
                <span class="font-semibold text-gray-700">Nama:</span>
                <span class="text-gray-900">{{ $pengaduan->user->name }}</span>
                </p>
                <p class="mb-3">
                <span class="font-semibold text-gray-700">Judul:</span>
                <span class="text-blue-700">{{ $pengaduan->judul }}</span>
                </p>
                <p class="mb-3">
                <span class="font-semibold text-gray-700">Kategori:</span>
                <span class="inline-block bg-indigo-100 text-indigo-800 px-2 py-1 rounded text-sm font-medium">
                    {{ $pengaduan->kategori->name_kategori ?? 'Tanpa Nama' }}
                </span>
                </p>
            </div>
            <div>
                <p class="mb-3">
                <span class="font-semibold text-gray-700">Status:</span>
                <span
                    class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                    @if ($pengaduan->status == 'terkirim') bg-yellow-100 text-yellow-800
                    @elseif($pengaduan->status == 'diproses') bg-blue-100 text-blue-800
                    @else bg-green-100 text-green-800 @endif
                ">
                    {{ ucfirst($pengaduan->status) }}
                </span>
                </p>
            </div>
            </div>
            <div class="mt-4">
            <p class="font-semibold text-gray-700 mb-1">Isi Pengaduan:</p>
            <div class="bg-white border rounded p-4 text-gray-800 shadow-sm">
                {{ $pengaduan->isi }}
            </div>
            </div>
        </div>

        @if ($pengaduan->gambar)
            <dt class="col-sm-3">Gambar</dt>
            <dd class="col-sm-9">
                <img src="{{ asset('storage/' . $pengaduan->gambar) }}" class="img-fluid rounded shadow-sm"
                    style="max-width:300px;">
            </dd>
        @endif

        <form method="POST" action="{{ route('admin.pengaduan.update', $pengaduan) }}" class="mb-6">
            @csrf
            @method('PUT')
            <label class="block mb-2 font-semibold text-blue-700">Update Status:</label>
            <div class="flex items-center space-x-4">
            <select name="status" class="rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                <option value="terkirim" {{ $pengaduan->status == 'terkirim' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Sedang diproses</option>
                <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">Update</button>
            </div>
        </form>

        <a href="{{ route('admin.pengaduan.index') }}" class="inline-block text-blue-600 hover:underline">
            ← Kembali ke daftar
        </a>
    </div>
@endsection
