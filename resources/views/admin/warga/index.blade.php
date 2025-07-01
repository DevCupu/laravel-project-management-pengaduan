@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Warga Terdaftar</h1>

            <a href="{{ route('admin.warga.create') }}"
                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Warga
            </a>
        </div>

        <form method="GET" action="{{ route('admin.warga.index') }}"
            class="flex flex-wrap items-end gap-4 bg-white p-4 rounded-lg shadow-sm border mb-6">
            {{-- Pencarian --}}
            <div class="flex flex-col">
                <label for="search" class="text-xs font-semibold text-gray-600 mb-1">Cari NIK / Nama</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    placeholder="Masukkan NIK atau Nama"
                    class="border border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2 rounded-md text-sm transition w-48"
                    autocomplete="off">
            </div>

            {{-- Filter Kelurahan --}}
            <div class="flex flex-col">
                <label for="kelurahan" class="text-xs font-semibold text-gray-600 mb-1">Filter Kelurahan</label>
                <select id="kelurahan" name="kelurahan" onchange="this.form.submit()"
                    class="border border-gray-300 focus:border-blue-500 focus:ring-blue-500 px-3 py-2 rounded-md text-sm transition w-48">
                    <option value="">-- Semua Kelurahan --</option>
                    @foreach ($kelurahanList as $kel)
                        <option value="{{ $kel }}" {{ request('kelurahan') == $kel ? 'selected' : '' }}>
                            {{ $kel }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol cari --}}
            <div class="flex flex-col">
                <label class="invisible mb-1">&nbsp;</label>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-semibold shadow transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    Filter
                </button>
            </div>

            {{-- Reset --}}
            @if (request()->filled('search') || request()->filled('kelurahan'))
                <div class="flex flex-col">
                    <label class="invisible mb-1">&nbsp;</label>
                    <a href="{{ route('admin.warga.index') }}"
                        class="inline-flex items-center gap-1 text-sm text-red-600 hover:text-red-800 underline ml-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset
                    </a>
                </div>
            @endif

            {{-- Info filter aktif --}}
            @if (request()->filled('search') || request()->filled('kelurahan'))
                <div class="flex flex-col flex-1 min-w-[200px]">
                    <label class="text-xs font-semibold text-gray-600 mb-1">Filter Aktif</label>
                    <div class="text-xs text-gray-700 bg-gray-100 rounded px-3 py-2">
                        @if (request()->filled('search'))
                            <span class="font-semibold">Pencarian:</span> "{{ request('search') }}"
                        @endif
                        @if (request()->filled('kelurahan'))
                            <span class="ml-2 font-semibold">Kelurahan:</span> "{{ request('kelurahan') }}"
                        @endif
                    </div>
                </div>
            @endif
        </form>

        @if (session('success'))
            <div class="flex items-center bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelurahan
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($warga as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $warga->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->nik }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->alamat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->kelurahan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.warga.edit', $item->id) }}"
                                    class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded hover:bg-yellow-200 transition text-xs font-semibold mr-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2l-6 6m-2 2h6" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('admin.warga.destroy', $item->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition text-xs font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500 text-sm">Belum ada data warga.</td>
                        </tr>
                    @endforelse

            </table>
            <div class="flex items-center justify-between mt-4 px-6 py-3 bg-gray-50 rounded-b-lg">
                <div class="text-sm text-gray-600">
                    @if ($warga->total() > 0)
                        Menampilkan
                        <span class="font-semibold">{{ $warga->firstItem() }}</span>
                        -
                        <span class="font-semibold">{{ $warga->lastItem() }}</span>
                        dari
                        <span class="font-semibold">{{ $warga->total() }}</span>
                        data warga
                    @else
                        Menampilkan 0 data warga
                    @endif
                </div>
                <div>
                    {{ $warga->links('pagination::tailwind') }}
                </div>
            </div>

        </div>
    </div>
@endsection
