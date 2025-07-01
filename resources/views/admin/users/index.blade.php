@extends('layouts.admin')

@section('content')
    <div class="container mx-auto mt-8 px-2 sm:px-8 max-w-full">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Verfikai Pelapor!</h2>
            <span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold shadow">
                Total Pengguna: {{ $users->count() }}
            </span>
        </div>

        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 flex items-center gap-3">
            <label for="filter" class="text-gray-700 font-medium">Filter:</label>
            <select id="filter" name="filter" onchange="this.form.submit()"
                class="block w-48 px-3 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                <option value="">Semua</option>
                <option value="verified" {{ request('filter') === 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                <option value="unverified" {{ request('filter') === 'unverified' ? 'selected' : '' }}>Belum Diverifikasi
                </option>
            </select>
        </form>

        @if (session('success'))
            <div class="flex items-center bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4 relative"
                role="alert">
                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
                <button type="button" class="absolute top-2 right-2 text-green-700 hover:text-green-900"
                    data-dismiss="alert" aria-label="Tutup">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama &
                            Tanggal Daftar</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIK
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status
                            Verifikasi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($users as $index => $user)
                        <tr>
                            <td class="px-4 py-3 align-middle text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 align-middle">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-lg mr-3">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500 flex items-center gap-1">
                                            <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            {{ $user->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 align-middle text-gray-700">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm0 0v1a4 4 0 01-8 0v-1"></path>
                                    </svg>
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-4 py-3 align-middle">
                                <span
                                    class="inline-block bg-gray-100 text-gray-700 text-xs px-3 py-1 rounded font-mono">{{ $user->nik }}</span>
                            </td>
                            <td class="px-4 py-3 align-middle">
                                @if ($user->is_verified)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terverifikasi
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                        Belum
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 align-middle">
                                @if ($user->is_verified)
                                    <form action="{{ route('admin.users.unverify', $user) }}" method="POST"
                                        onsubmit="return confirm('Batalkan verifikasi user ini?')" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 rounded-full bg-green-200 text-green-800 text-xs font-semibold gap-1 hover:bg-green-300 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Batalkan Verifikasi
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.verify', $user) }}" method="POST"
                                        onsubmit="return confirm('Verifikasi user ini?')" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold gap-1 hover:bg-yellow-200 transition">
                                            <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3">
                                                </path>
                                            </svg>
                                            Verifikasi sekarang!
                                        </button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-400 py-8">
                                <svg class="mx-auto mb-2 w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75">
                                    </path>
                                </svg>
                                Belum ada user terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="m-5 mt-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div class="text-gray-600 text-sm text-center sm:text-left">
                    <span>Menampilkan</span>
                    <span class="font-semibold">{{ $users->firstItem() ?? 0 }}</span>
                    <span>-</span>
                    <span class="font-semibold">{{ $users->lastItem() ?? 0 }}</span>
                    <span>dari</span>
                    <span class="font-semibold">{{ $users->total() }}</span>
                    <span>pengguna</span>
                </div>
                <div class="flex justify-center sm:justify-end">
                    {{ $users->withQueryString()->links('vendor.pagination.tailwind') }}
                </div>
            </div>

        </div>
    </div>

    @push('styles')
        <style>
            /* Custom animation for shake */
            @keyframes shake {

                10%,
                90% {
                    transform: translateX(-1px);
                }

                20%,
                80% {
                    transform: translateX(2px);
                }

                30%,
                50%,
                70% {
                    transform: translateX(-4px);
                }

                40%,
                60% {
                    transform: translateX(4px);
                }
            }

            .animate-shake {
                animation: shake 0.8s cubic-bezier(.36, .07, .19, .97) both;
            }
        </style>
    @endpush
@endsection
