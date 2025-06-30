<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPengaduan extends Model
{
    protected $table = 'kategori_pengaduans';
    protected $fillable = ['name_kategori'];

    public function pengaduans()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id');
    }
}
