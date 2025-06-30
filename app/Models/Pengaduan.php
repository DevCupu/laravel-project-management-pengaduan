<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'isi',
        'gambar',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriPengaduan::class, 'kategori_id');
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function lampiran()
    {
        return $this->hasMany(LampiranPengaduan::class);
    }
}

