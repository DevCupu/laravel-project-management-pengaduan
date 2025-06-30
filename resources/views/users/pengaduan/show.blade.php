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

                <a href="{{ route('users.pengaduan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
