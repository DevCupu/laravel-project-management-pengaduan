@extends('layouts.users')

@section('content')
    <div class="container mt-4">

        {{-- Ringkasan Cepat --}}
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $pengaduan->judul }}</strong><br>
                oleh <em>{{ $pengaduan->user->name ?? 'User' }}</em> pada {{ $pengaduan->created_at->format('d M Y, H:i') }}
            </div>
            <span
                class="badge 
            @if ($pengaduan->status == 'terkirim') bg-secondary
            @elseif($pengaduan->status == 'diproses') bg-warning
            @else bg-success @endif">
                {{ ucfirst($pengaduan->status) }}
            </span>
        </div>

        {{-- Card Detail --}}
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Detail Pengaduan</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Judul</dt>
                    <dd class="col-sm-9">{{ $pengaduan->judul }}</dd>

                    <dt class="col-sm-3">Kategori</dt>
                    <dd class="col-sm-9">{{ $pengaduan->kategori->name_kategori ?? '-' }}</dd>

                    <dt class="col-sm-3">Dikirim Oleh</dt>
                    <dd class="col-sm-9">{{ $pengaduan->user->name ?? '-' }}</dd>

                    <dt class="col-sm-3">Isi</dt>
                    <dd class="col-sm-9">{{ $pengaduan->isi }}</dd>

                    <dt class="col-sm-3 mb-3">Status</dt>
                    <dd class="col-sm-9">
                        <span
                            class="badge 
                        @if ($pengaduan->status == 'terkirim') bg-secondary
                        @elseif($pengaduan->status == 'diproses') bg-warning
                        @else bg-success @endif">
                            {{ ucfirst($pengaduan->status) }}
                        </span>
                    </dd>

                    <dt class="col-sm-3">Progress</dt>
                    <dd class="col-sm-9">
                        <div class="progress">
                            <div class="progress-bar 
                            @if ($pengaduan->status == 'terkirim') bg-secondary
                            @elseif($pengaduan->status == 'diproses') bg-warning
                            @else bg-success @endif"
                                role="progressbar"
                                style="width: 
                                @if ($pengaduan->status == 'terkirim') 33%
                                @elseif($pengaduan->status == 'diproses') 66%
                                @else 100% @endif">
                                {{ ucfirst($pengaduan->status) }}
                            </div>
                        </div>
                    </dd>

                    <dt class="col-sm-3">Tanggal Dibuat</dt>
                    <dd class="col-sm-9">{{ $pengaduan->created_at->format('d M Y, H:i') }}</dd>

                    <dt class="col-sm-3">Terakhir Diperbarui</dt>
                    <dd class="col-sm-9">{{ $pengaduan->updated_at->format('d M Y, H:i') }}</dd>

                    @if ($pengaduan->gambar)
                        <dt class="col-sm-3">Gambar</dt>
                        <dd class="col-sm-9">
                            <img src="{{ asset('storage/' . $pengaduan->gambar) }}" class="img-fluid rounded shadow-sm"
                                style="max-width:300px;">
                        </dd>
                    @endif
                </dl>

                {{-- Lampiran --}}
                @if ($pengaduan->lampiran && $pengaduan->lampiran->isNotEmpty())
                    <div class="mt-4">
                        <h5 class="mb-2 fw-bold">Lampiran</h5>
                        <ul class="list-unstyled">
                            @foreach ($pengaduan->lampiran as $lampiran)
                                <li class="mb-2">
                                    <a href="{{ asset('storage/' . $lampiran->file_path) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-paperclip"></i>
                                        Lihat Lampiran
                                        ({{ strtoupper(pathinfo($lampiran->file_path, PATHINFO_EXTENSION)) }})
                                    </a>
                                    <span class="text-muted ms-2">{{ basename($lampiran->file_path) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Komentar admin --}}
                @if ($pengaduan->komentar->isNotEmpty())
                    <div class="mt-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-chat-dots"></i> Komentar Admin</h5>
                        @foreach ($pengaduan->komentar as $komentar)
                            <div class="card mb-3 shadow-sm border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-info text-dark me-2">
                                            {{ $komentar->user->name ?? 'Admin' }}
                                        </span>
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i>
                                            {{ $komentar->created_at->format('d M Y, H:i') }}
                                        </small>
                                    </div>
                                    <div class="ps-1">
                                        {!! nl2br(e($komentar->isi_komentar)) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="mt-4 text-muted fst-italic">
                        <i class="bi bi-info-circle"></i> Belum ada komentar dari admin.
                    </div>
                @endif

                <a href="{{ route('users.pengaduan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
