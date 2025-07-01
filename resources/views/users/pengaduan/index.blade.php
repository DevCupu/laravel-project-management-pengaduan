@extends('layouts.users')

@section('content')
    <div class="max-w-6xl mx-auto mt-10">
        <h1 class="text-3xl font-extrabold mb-8 text-indigo-500 flex items-center gap-2">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 17v-2a4 4 0 014-4h4m0 0V7a4 4 0 00-4-4H7a4 4 0 00-4 4v10a4 4 0 004 4h4"></path>
            </svg>
            Daftar Pengaduan Anda
        </h1>

        {{-- Section: Tambah Pengaduan --}}
        <div class="mb-8">
            <a href="{{ route('users.pengaduan.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Pengaduan
            </a>
        </div>

        @forelse ($pengaduans as $pengaduan)
            <div
                class="bg-white shadow-lg p-6 rounded-xl mb-6 border-l-4 @if ($pengaduan->status == 'selesai') border-green-500 @elseif($pengaduan->status == 'proses') border-yellow-500 @else border-gray-300 @endif transition hover:shadow-xl">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"></path>
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"
                                fill="none" />
                        </svg>
                        {{ $pengaduan->judul }}
                    </h2>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-bold
                        @if ($pengaduan->status == 'selesai') bg-green-100 text-green-700
                        @elseif($pengaduan->status == 'proses') bg-yellow-100 text-yellow-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </div>
                {{-- Status description --}}
                <div class="mb-2">
                    @if ($pengaduan->status == 'selesai')
                        <span class="text-green-700 text-sm">Pengaduan telah selesai diproses terimkasih telah mengirim
                            pengaduan, pihak terkait akan segera tindak lanjut</span>
                    @elseif ($pengaduan->status == 'proses')
                        <span class="text-yellow-700 text-sm">Pengaduan sedang dalam proses penanganan.</span>
                    @else
                        <span class="text-gray-700 text-sm">Pengaduan anda menunggu diproses oleh admin.</span>
                    @endif
                </div>
                <p class="text-gray-500 text-xs mb-2">
                    <svg class="inline w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ $pengaduan->created_at->format('d M Y, H:i') }}
                </p>
                <p class="mt-2 text-gray-700">{{ Str::limit($pengaduan->isi, 120) }}</p>

                <div class="mt-4 flex justify-between items-center">
                    <div class="flex gap-2">
                        <a href="{{ route('users.pengaduan.show', $pengaduan->id) }}"
                            class="text-blue-600 font-semibold hover:underline flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l7-7-7-7"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2 12h20"></path>
                            </svg>
                            Lihat Detail
                        </a>
                        <a href="{{ route('users.pengaduan.edit', $pengaduan->id) }}"
                            class="text-yellow-600 font-semibold hover:underline flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-2.828 0L5 11.828a2 2 0 010-2.828L13 5">
                                </path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('users.pengaduan.destroy', $pengaduan->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-600 font-semibold hover:underline flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded text-yellow-800">
                <p>Belum ada pengaduan yang Anda buat.</p>
            </div>
        @endforelse
    </div>
@endsection
