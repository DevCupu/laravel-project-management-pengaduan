@extends('layouts.admin')

@section('content')
    <div class="max-w-8xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
            <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Daftar Semua Pengaduan
        </h2>

        {{-- Filter Form --}}
        <form method="GET" class="mb-6 flex flex-wrap gap-4 items-end">
            <div>
                <label for="status" class="block text-xs font-semibold text-gray-600 mb-1">Status</label>
                <select name="status" id="status" class="rounded border-gray-300">
                    <option value="">Semua</option>
                    <option value="terkirim" {{ request('status') == 'terkirim' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Sedang Diproses
                    </option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div>
                <label for="search" class="block text-xs font-semibold text-gray-600 mb-1">Cari Judul/Isi</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="rounded border-gray-300" placeholder="Kata kunci...">
            </div>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Filter</button>
            @if (request()->has('status') || request()->has('search'))
                <a href="{{ route('admin.pengaduan.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">Reset</a>
            @endif
        </form>

        @if (session('success'))
            <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>

                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">User</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Judul</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Isi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                    <tr>
                        <td colspan="7" class="px-4 py-2 bg-blue-50 text-blue-800 text-sm font-semibold">
                            Total Pengaduan: {{ $pengaduans->total() }}
                        </td>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($pengaduans as $index => $pengaduan)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-4 whitespace-nowrap text-gray-700 text-center font-semibold">
                                {{ $pengaduans->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap flex items-center gap-3">
                                <span
                                    class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 text-white font-bold shadow">
                                    {{ strtoupper(substr($pengaduan->user->name, 0, 1)) }}
                                </span>
                                <div>
                                    <div class="font-medium text-gray-800 truncate max-w-[120px]">{{ Str::limit($pengaduan->user->name, 15) }}</div>
                                    <div class="text-xs text-gray-400 truncate max-w-[120px]">{{ Str::limit($pengaduan->user->email ?? '-', 20) }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-gray-900 font-semibold truncate max-w-[120px]">{{ Str::limit($pengaduan->judul, 20) }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-gray-600 max-w-xs truncate max-w-[180px]">
                                <span title="{{ $pengaduan->isi }}">{{ Str::limit($pengaduan->isi, 30) }}</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-gray-500 text-sm">
                                <span class="inline-flex items-center gap-1">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 7V3m8 4V3m-9 8h10m-9 4h6m-7 4h8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ $pengaduan->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @if ($pengaduan->status === 'selesai')
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800 gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Selesai
                                    </span>
                                @elseif ($pengaduan->status === 'proses' || $pengaduan->status === 'diproses')
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-800 gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 8v4l3 3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Proses
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-800 gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        {{ ucfirst($pengaduan->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap flex gap-2">
                                <a href="{{ route('admin.pengaduan.show', $pengaduan) }}"
                                    class="inline-flex items-center px-3 py-1 text-xs font-semibold text-blue-600 hover:text-white hover:bg-blue-600 border border-blue-600 rounded transition gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                                @if ($pengaduan->status !== 'selesai')
                                    <form method="POST" action="{{ route('admin.pengaduan.update', $pengaduan) }}"
                                        class="inline" onsubmit="return confirm('Tandai selesai?')">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 rounded transition gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Tandai Selesai
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-400">Belum ada pengaduan.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            <div class="mt-6 flex flex-col md:flex-row justify-between items-center gap-4 px-4 py-3 bg-gray-50 rounded-b-lg border-t">
                <div class="text-sm text-gray-600">
                    Menampilkan
                    <span class="font-semibold text-gray ">{{ $pengaduans->firstItem() ?? 0 }}</span>
                    -
                    <span class="font-semibold text-gray">{{ $pengaduans->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-semibold text-gray">{{ $pengaduans->total() }}</span>
                    data
                </div>
                <div class="w-full md:w-auto">
                    {{ $pengaduans->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        </div>
    </div>
@endsection
