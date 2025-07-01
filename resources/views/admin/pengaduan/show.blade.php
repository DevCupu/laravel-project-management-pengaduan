@extends('layouts.admin')

@section('content')
    <div
        class="max-w-5xl mx-auto bg-gradient-to-br from-indigo-50 to-white shadow-2xl rounded-2xl p-10 mt-10 border border-indigo-100">
        <div class="flex items-center mb-8">
            <div class="flex-shrink-0">
                <div
                    class="h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-3xl font-bold shadow">
                    <i class="bi bi-person"></i>
                </div>
            </div>
            <div class="ml-5">
                <h2 class="text-3xl font-extrabold text-indigo-800 mb-1">Detail Pengaduan</h2>
                <p class="text-gray-500">Informasi lengkap pengaduan dari <span
                        class="font-semibold">{{ $pengaduan->user->name }}</span></p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <div class="mb-4">
                    <span class="block text-gray-500 font-medium">Nama Pelapor</span>
                    <span class="text-lg font-semibold text-gray-900">{{ $pengaduan->user->name }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-gray-500 font-medium">Judul Pengaduan</span>
                    <span class="text-lg font-semibold text-blue-700">{{ $pengaduan->judul }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-gray-500 font-medium">Kategori</span>
                    <span
                        class="inline-block bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold shadow">
                        {{ $pengaduan->kategori->name_kategori ?? 'Tanpa Nama' }}
                    </span>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <span class="block text-gray-500 font-medium">Status</span>
                    <span
                        class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold shadow
                        @if ($pengaduan->status == 'terkirim') bg-yellow-100 text-yellow-800
                        @elseif($pengaduan->status == 'diproses') bg-blue-100 text-blue-800
                        @else bg-green-100 text-green-800 @endif
                    ">
                        @if ($pengaduan->status == 'terkirim')
                            <i class="bi bi-hourglass-split mr-2"></i>
                        @elseif($pengaduan->status == 'diproses')
                            <i class="bi bi-gear-fill mr-2"></i>
                        @else
                            <i class="bi bi-check-circle-fill mr-2"></i>
                        @endif
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </div>
                <div class="mb-4">
                    <span class="block text-gray-500 font-medium">Tanggal Pengaduan</span>
                    <span class="text-md text-gray-800">{{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <span class="block font-semibold text-gray-700 mb-2">Isi Pengaduan</span>
            <div class="bg-white border-l-4 border-indigo-400 rounded p-5 text-gray-800 shadow-inner">
                {{ $pengaduan->isi }}
            </div>
        </div>

        @if ($pengaduan->gambar)
            <div class="mb-8">
                <span class="block font-semibold text-gray-700 mb-2">Gambar Terkait</span>
                <img src="{{ asset('storage/' . $pengaduan->gambar) }}"
                    class="rounded-lg shadow-lg border border-indigo-100"
                    style="max-width: 100%; max-height: 350px; object-fit:cover;">
            </div>
        @endif

        @if ($pengaduan->lampiran && $pengaduan->lampiran->isNotEmpty())
            <div class="mb-8">
                <span class="block font-semibold text-gray-700 mb-2">Lampiran</span>
                <ul class="space-y-2">
                    @foreach ($pengaduan->lampiran as $lampiran)
                        <li class="flex items-center bg-indigo-50 rounded px-4 py-2 shadow-sm">
                            <i class="bi bi-paperclip text-indigo-600 mr-3"></i>
                            <a href="{{ asset('storage/' . $lampiran->file_path) }}" target="_blank"
                                class="text-indigo-700 hover:underline font-medium">
                                Lihat Lampiran ({{ strtoupper(pathinfo($lampiran->file_path, PATHINFO_EXTENSION)) }})
                            </a>
                            <span class="text-gray-400 ml-3 text-xs">{{ basename($lampiran->file_path) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-10">
            <h3 class="text-xl font-bold text-indigo-800 mb-4 flex items-center">
            <i class="bi bi-chat-dots mr-2"></i> Tanggapan Admin
            </h3>

            <form action="{{ route('admin.pengaduan.komentar.store', $pengaduan->id) }}" method="POST" class="mb-6">
            @csrf
            <textarea name="isi_komentar"
                class="w-full border border-indigo-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 mb-3 resize-none"
                rows="4"
                placeholder="Tulis tanggapan Anda di sini..." required></textarea>
            <div class="flex justify-end">
                <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow transition flex items-center">
                <i class="bi bi-send mr-2"></i>Kirim Tanggapan
                </button>
            </div>
            </form>

            @if ($pengaduan->komentar->isNotEmpty())
            <div class="bg-white rounded-lg shadow p-4">
                <h4 class="font-semibold text-indigo-700 mb-3">Riwayat Tanggapan</h4>
                <ul class="space-y-4">
                @foreach ($pengaduan->komentar as $komentar)
                    <li class="border-b last:border-b-0 pb-3">
                    <div class="flex items-center mb-1">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold mr-2">
                        <i class="bi bi-person"></i>
                        </div>
                        <span class="font-bold text-indigo-800">{{ $komentar->user->name }}</span>
                        <span class="ml-2 text-xs text-gray-400">
                        {{ $komentar->created_at->format('d M Y, H:i') }}
                        </span>
                        @if (auth()->user()->id === $komentar->user_id)
                        <div class="ml-auto flex space-x-2">
                            <form action="{{ route('admin.pengaduan.komentar.destroy', $komentar->id) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Yakin ingin menghapus tanggapan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs font-semibold transition shadow">
                                    <i class="bi bi-trash mr-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                    <div class="bg-indigo-50 rounded p-3 text-gray-800 mt-1 whitespace-pre-line">
                        {{ $komentar->isi_komentar }}
                    </div>
                    </li>
                @endforeach
                </ul>
            </div>
            @else
            <div class="text-gray-500 italic">Belum ada riwayat!</div>
            @endif
        </div>


        <form method="POST" action="{{ route('admin.pengaduan.update', $pengaduan) }}"
            class="mb-8 bg-indigo-50 rounded-lg p-6 shadow">
            @csrf
            @method('PUT')
            <label class="block mb-2 font-semibold text-indigo-700">Update Status Pengaduan</label>
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-3 md:space-y-0">
                <select name="status"
                    class="rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2">
                    <option value="terkirim" {{ $pengaduan->status == 'terkirim' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Sedang diproses
                    </option>
                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded shadow transition">
                    <i class="bi bi-arrow-repeat mr-2"></i>Update
                </button>
            </div>
        </form>

        <a href="{{ route('admin.pengaduan.index') }}"
            class="inline-flex items-center text-indigo-600 hover:underline font-medium">
            <i class="bi bi-arrow-left mr-2"></i> Kembali ke daftar
        </a>
    </div>
@endsection
